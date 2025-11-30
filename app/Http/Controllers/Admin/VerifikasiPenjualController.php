<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenjualProfile;
use Illuminate\Http\Request;

class VerifikasiPenjualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjualProfiles = PenjualProfile::with('user')
            ->where('status_verifikasi', 'pending')
            ->latest()
            ->get();
        return view('admin.verifikasi-penjual.index', compact('penjualProfiles'));
    }

    /**
     * Display the specified resource.
     */
    public function show(PenjualProfile $verifikasi_penjual)
    {
        $verifikasi_penjual->load('user');
        return view('admin.verifikasi-penjual.show', compact('verifikasi_penjual'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PenjualProfile $verifikasi_penjual)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:verified,rejected',
        ]);

        $verifikasi_penjual->update([
            'status_verifikasi' => $request->status_verifikasi,
        ]);

        $statusText = $request->status_verifikasi === 'verified' ? 'diverifikasi' : 'ditolak';
        return redirect()->route('admin.verifikasi-penjual.index')
            ->with('success', "Penjual berhasil $statusText");
    }
}
