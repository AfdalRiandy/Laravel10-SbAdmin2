<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $orders = Order::whereHas('items.product', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->with(['user', 'items.product' => function($q) use ($user) {
            $q->where('user_id', $user->id)->with('images');
        }])->latest()->get();

        return view('seller.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        // Ensure order contains seller's products
        $hasProduct = $order->items()->whereHas('product', function($q) {
            $q->where('user_id', auth()->id());
        })->exists();

        if (!$hasProduct) {
            abort(403);
        }

        $order->load(['user', 'items.product.images']);
        return view('seller.order.show', compact('order'));
    }
}
