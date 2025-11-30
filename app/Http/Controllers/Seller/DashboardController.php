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
        $totalRevenue = Order::where('status', 'completed')
            ->with(['items.product'])
            ->get()
            ->sum(function($order) use ($user) {
                return $order->items->sum(function($item) use ($user) {
                    return $item->product->user_id == $user->id ? $item->price * $item->quantity : 0;
                });
            });

        $recentOrders = Order::whereHas('items.product', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['user', 'items.product' => function($q) use ($user) {
            $q->where('user_id', $user->id);
        }])->latest()->limit(5)->get();

        return view('seller.dashboard', compact('totalProducts', 'totalOrders', 'totalRevenue', 'recentOrders'));
    }
}
