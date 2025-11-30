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

        $orders = Order::with(['items.product', 'user'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', '!=', 'cancelled')
            ->latest()
            ->get();

        $totalSales = $orders->sum('total_price');
        $totalOrders = $orders->count();

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
        $bestSelling = Product::select('products.*')
            ->selectRaw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(5)
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
            ->selectRaw('COALESCE(SUM(orders.total_price), 0) as total_sales')
            ->leftJoin('products', 'users.id', '=', 'products.seller_id')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->leftJoin('orders', function($join) {
                $join->on('order_items.order_id', '=', 'orders.id')
                    ->where('orders.status', '=', 'completed');
            })
            ->groupBy('users.id')
            ->orderByDesc('total_sales')
            ->limit(3)
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
