<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\PenjualProfile;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function edit()
    {
        $profile = auth()->user()->penjualProfile;
        if (!$profile) {
            $profile = PenjualProfile::create(['user_id' => auth()->id()]);
        }
        return view('seller.shop.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        $profile = auth()->user()->penjualProfile;
        $profile->update([
            'shop_name' => $request->shop_name,
            'description' => $request->description,
            'phone' => $request->phone,
            'alamat_toko' => $request->address,
        ]);

        return redirect()->back()->with('success', 'Profil toko berhasil diperbarui');
    }
}
