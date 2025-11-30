<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])
            ->whereNotNull('payment_proof')
            ->where('status', 'pending')
            ->latest()
            ->get();
        return view('admin.payment.index', compact('orders'));
    }

    public function confirm(Order $order)
    {
        $order->update(['status' => 'paid']);
        return redirect()->back()->with('success', 'Pembayaran berhasil dikonfirmasi');
    }

    public function reject(Order $order)
    {
        $order->update(['status' => 'cancelled']);
        return redirect()->back()->with('success', 'Pembayaran ditolak');
    }
}
