<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruPendampingController extends Controller
{
    public function dashboard()
    {
        $totalStudents = User::role('penjual')->count();
        return view('guru_pendamping.dashboard', compact('totalStudents'));
    }

    public function students()
    {
        $students = User::role('penjual')->with(['penjualProfile', 'products'])->get();
        return view('guru_pendamping.students.index', compact('students'));
    }

    public function showStudent($id)
    {
        $student = User::role('penjual')->with(['penjualProfile', 'products'])->findOrFail($id);
        
        // Statistics
        $totalProducts = $student->products()->count();
        
        $totalOrders = Order::whereHas('items.product', function($q) use ($student) {
            $q->where('user_id', $student->id);
        })->where('status', 'completed')->count();

        $totalRevenue = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('products.user_id', $student->id)
            ->where('orders.status', 'completed')
            ->sum(DB::raw('order_items.price * order_items.quantity'));

        // Monthly Sales Chart Data
        $monthlySales = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->where('products.user_id', $student->id)
            ->where('orders.status', 'completed')
            ->whereYear('orders.created_at', Carbon::now()->year)
            ->selectRaw('MONTH(orders.created_at) as month, SUM(order_items.price * order_items.quantity) as total')
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

        // Recent Products
        $recentProducts = $student->products()->latest()->take(5)->get();

        return view('guru_pendamping.students.show', compact(
            'student', 
            'totalProducts', 
            'totalOrders', 
            'totalRevenue', 
            'salesData',
            'recentProducts'
        ));
    }

    public function salesReport()
    {
        $students = User::role('penjual')
            ->with(['penjualProfile'])
            ->select('users.*')
            ->selectRaw('(SELECT COALESCE(SUM(order_items.quantity * order_items.price), 0) 
                FROM order_items 
                JOIN products ON products.id = order_items.product_id 
                JOIN orders ON orders.id = order_items.order_id 
                WHERE products.user_id = users.id 
                AND orders.status = "completed") as total_sales')
            ->selectRaw('(SELECT COALESCE(SUM(order_items.quantity), 0) 
                FROM order_items 
                JOIN products ON products.id = order_items.product_id 
                JOIN orders ON orders.id = order_items.order_id 
                WHERE products.user_id = users.id 
                AND orders.status = "completed") as total_sold')
            ->orderByDesc('total_sales')
            ->get();

        return view('guru_pendamping.reports.sales', compact('students'));
    }
}
