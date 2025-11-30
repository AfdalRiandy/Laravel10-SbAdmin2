<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
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
        
        $paymentMethods = PaymentMethod::where('is_active', true)->get();
        
        return view('checkout.index', compact('cart', 'paymentMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'payment_method_id' => 'required|exists:payment_methods,id',
        ]);

        $paymentMethod = PaymentMethod::findOrFail($request->payment_method_id);
        
        if ($paymentMethod->type !== 'cod') {
            $request->validate([
                'payment_proof' => 'required|image|max:2048',
            ]);
        }

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
            'payment_method_id' => $request->payment_method_id,
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
