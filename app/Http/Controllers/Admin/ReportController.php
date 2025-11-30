<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\PenjualProfile;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $startDate = $request->start_date ?? now()->startOfMonth();
        $endDate = $request->end_date ?? now();

        $orders = Order::with(['items.product.images', 'user'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled')
            ->latest()
            ->paginate(20);

        $totalSales = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled')
            ->sum('total_price');
            
        $totalOrders = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled')
            ->count();

        return view('admin.report.sales', compact('orders', 'totalSales', 'totalOrders', 'startDate', 'endDate'));
    }

    public function products()
    {
        $products = Product::with(['category', 'user', 'reviews'])
            ->latest()
            ->get();

        $totalProducts = $products->count();
        $activeProducts = $products->where('is_active', true)->count();
        $lowStock = $products->where('stock', '>', 0)->where('stock', '<=', 10)->count();
        $outOfStock = $products->where('stock', '<=', 0)->count();

        // Products by category
        $productsByCategory = Category::withCount('products')->get();

        // Best selling products
        $bestSelling = Product::withSum('items as total_sold', 'quantity')
            ->orderByDesc('total_sold')
            ->take(5)
            ->get();

        return view('admin.report.products', compact(
            'products', 
            'totalProducts', 
            'activeProducts', 
            'lowStock', 
            'outOfStock', 
            'productsByCategory', 
            'bestSelling'
        ));
    }

    public function sellers()
    {
        $sellers = User::role('penjual')
            ->with('penjualProfile')
            ->withCount('products')
            ->get();

        $totalSellers = $sellers->count();
        $verifiedSellers = $sellers->filter(function ($seller) {
            return $seller->penjualProfile && $seller->penjualProfile->status_verifikasi === 'verified';
        })->count();
        $pendingVerification = $sellers->filter(function ($seller) {
            return $seller->penjualProfile && $seller->penjualProfile->status_verifikasi === 'pending';
        })->count();

        // Top sellers by sales
        $topSellers = User::role('penjual')
            ->with('penjualProfile')
            ->withCount('products')
            ->select('users.*')
            ->selectRaw('(SELECT COALESCE(SUM(order_items.quantity * order_items.price), 0) 
                FROM order_items 
                JOIN products ON products.id = order_items.product_id 
                JOIN orders ON orders.id = order_items.order_id 
                WHERE products.user_id = users.id 
                AND orders.status = "completed") as total_sales')
            ->orderByDesc('total_sales')
            ->take(5)
            ->get();

        return view('admin.report.sellers', compact(
            'sellers', 
            'totalSellers', 
            'verifiedSellers', 
            'pendingVerification', 
            'topSellers'
        ));
    }
}