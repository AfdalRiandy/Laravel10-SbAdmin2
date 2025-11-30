<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart()->with('items.product')->firstOrCreate(['user_id' => auth()->id()]);
        return view('cart.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $cart = auth()->user()->cart()->firstOrCreate(['user_id' => auth()->id()]);
        $cartItem = $cart->items()->where('product_id', $request->product_id)->first();
        
        if ($cartItem) {
            $cartItem->increment('quantity', $request->quantity ?? 1);
        } else {
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => $request->quantity ?? 1
            ]);
        }
        
        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang');
    }

    public function destroy($id)
    {
        CartItem::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Produk dihapus dari keranjang');
    }
}
