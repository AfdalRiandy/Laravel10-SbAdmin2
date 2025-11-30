<?php

namespace App\Http\Controllers;

use App\Models\PenjualProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembeliController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $penjualProfile = $user->penjualProfile;
        return view('pembeli.dashboard', compact('penjualProfile'));
    }

    public function becomeSeller()
    {
        $user = Auth::user();
        
        // If already a seller, redirect to seller dashboard
        if ($user->hasRole('penjual')) {
            return redirect()->route('seller.dashboard');
        }

        // If already applied, show status
        if ($user->penjualProfile) {
            return redirect()->route('pembeli.dashboard')->with('info', 'Anda sudah mengajukan pendaftaran penjual.');
        }

        return view('pembeli.become_seller');
    }

    public function storeSeller(Request $request)
    {
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'nis' => 'required|string|max:20',
            'kelas' => 'required|string|max:20',
            'jurusan' => 'required|string|max:50',
            'alamat_toko' => 'required|string',
            'deskripsi_toko' => 'required|string',
            'selfie_photo' => 'required|image|max:2048',
            'shop_photo' => 'nullable|image|max:2048',
        ]);

        $selfiePath = $request->file('selfie_photo')->store('verification/selfie', 'public');
        $shopPath = $request->hasFile('shop_photo') ? $request->file('shop_photo')->store('verification/shop', 'public') : null;

        PenjualProfile::create([
            'user_id' => Auth::id(),
            'shop_name' => $request->shop_name,
            'phone' => $request->phone,
            'nis' => $request->nis,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'alamat_toko' => $request->alamat_toko,
            'deskripsi_toko' => $request->deskripsi_toko,
            'status_verifikasi' => 'pending',
            'selfie_photo' => $selfiePath,
            'shop_photo' => $shopPath,
        ]);

        return redirect()->route('pembeli.dashboard')->with('success', 'Pendaftaran berhasil dikirim. Mohon tunggu konfirmasi admin.');
    }

    public function orders()
    {
        $orders = Auth::user()->orders()->with(['items.product.images'])->whereIn('status', ['pending', 'processing', 'shipped'])->latest()->get();
        return view('pembeli.orders.index', compact('orders'));
    }

    public function history()
    {
        $orders = Auth::user()->orders()->with(['items.product.images'])->whereIn('status', ['completed', 'cancelled'])->latest()->get();
        return view('pembeli.history.index', compact('orders'));
    }
}
