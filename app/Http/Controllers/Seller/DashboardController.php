<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        $totalProducts = Product::where('user_id', $user->id)->count();
        
        // Orders that contain products from this seller
        $totalOrders = Order::whereHas('items.product', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();

        // Calculate revenue from completed orders for this seller's products
        $totalRevenue = \Illuminate\Support\Facades\DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('products.user_id', $user->id)
            ->where('orders.status', 'completed')
            ->sum(\Illuminate\Support\Facades\DB::raw('order_items.price * order_items.quantity'));

        $recentOrders = Order::whereHas('items.product', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['user', 'items.product.images' => function($q) use ($user) {
            $q->where('user_id', $user->id);
        }])->latest()->limit(5)->get();

        return view('seller.dashboard', compact('totalProducts', 'totalOrders', 'totalRevenue', 'recentOrders'));
    }
}
