<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopProfileController extends Controller
{
    public function show($id)
    {
        $seller = User::with('penjualProfile')->findOrFail($id);
        
        // Ensure user is a seller
        if (!$seller->hasRole('penjual')) {
            abort(404);
        }

        $products = Product::where('user_id', $seller->id)
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('shop.show', compact('seller', 'products'));
    }
}
