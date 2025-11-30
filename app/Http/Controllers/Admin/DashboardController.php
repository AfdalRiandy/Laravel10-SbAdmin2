<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Summary statistics
        $totalUsers = User::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        // Pending items
        $pendingOrders = Order::where('status', 'pending')->count();
        $pendingPayments = Order::whereNotNull('payment_proof')->where('status', 'pending')->count();
        $pendingVerifications = User::role('penjual')
            ->whereHas('penjualProfile', function ($query) {
                $query->where('status_verifikasi', 'pending');
            })->count();

        // Recent orders
        $recentOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->limit(5)
            ->get();

        // Monthly sales chart data
        $monthlySales = Order::where('status', 'completed')
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        // Fill missing months with 0
        $salesData = [];
        for ($i = 1; $i <= 12; $i++) {
            $salesData[] = $monthlySales[$i] ?? 0;
        }

        // Products by category
        $categoriesData = Category::withCount('products')
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'count' => $category->products_count
                ];
            });

        // Low stock alert
        $lowStockProducts = Product::where('stock', '<=', 10)
            ->where('stock', '>', 0)
            ->with('category', 'user')
            ->limit(5)
            ->get();

        // New sellers this month
        $newSellers = User::role('penjual')
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalProducts',
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'pendingPayments',
            'pendingVerifications',
            'recentOrders',
            'salesData',
            'categoriesData',
            'lowStockProducts',
            'newSellers'
        ));
    }
}
