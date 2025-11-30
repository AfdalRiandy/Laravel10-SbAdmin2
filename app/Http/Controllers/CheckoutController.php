<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->with('items.product')->first();
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong');
        }
        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'payment_proof' => 'required|image|max:2048',
        ]);

        $cart = auth()->user()->cart;
        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'invoice_number' => 'INV-' . strtoupper(Str::random(10)),
            'total_price' => $total,
            'status' => 'pending',
            'shipping_address' => $request->shipping_address,
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $order->update(['payment_proof' => $path]);
        }

        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
            // Reduce stock
            $item->product->decrement('stock', $item->quantity);
        }

        // Clear cart
        $cart->items()->delete();

        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat!');
    }
}
