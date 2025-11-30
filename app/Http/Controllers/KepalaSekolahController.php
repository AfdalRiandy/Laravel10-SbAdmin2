<?php

namespace App\Http\Controllers;

use App\Models\PenjualProfile;
use App\Models\User;
use Illuminate\Http\Request;

class KepalaSekolahController extends Controller
{
    public function dashboard()
    {
        // Stats for dashboard
        $pendingVerifications = PenjualProfile::where('status_verifikasi', 'pending')->count();
        $activeSellers = PenjualProfile::where('status_verifikasi', 'verified')->count();
        $totalStudents = User::role('penjual')->count(); 
        
        // New stats
        $totalTransactions = \App\Models\Order::whereIn('status', ['paid', 'shipped', 'completed'])->count();
        $totalRevenue = \App\Models\Order::whereIn('status', ['paid', 'shipped', 'completed'])->sum('total_price');
        
        return view('kepala_sekolah.dashboard', compact('pendingVerifications', 'activeSellers', 'totalStudents', 'totalTransactions', 'totalRevenue'));
    }

    public function verifikasiPenjual()
    {
        $pendingSellers = PenjualProfile::with('user')
            ->where('status_verifikasi', 'pending')
            ->latest()
            ->get();

        return view('kepala_sekolah.verifikasi_penjual', compact('pendingSellers'));
    }

    public function showVerifikasi($id)
    {
        $profile = PenjualProfile::with('user')->findOrFail($id);
        $guruPendampings = User::role('guru_pendamping')->get();

        return view('kepala_sekolah.show_verifikasi', compact('profile', 'guruPendampings'));
    }

    public function approvePenjual(Request $request, $id)
    {
        $request->validate([
            'guru_pendamping_id' => 'required|exists:users,id',
        ]);

        $profile = PenjualProfile::findOrFail($id);
        
        $profile->update([
            'status_verifikasi' => 'verified',
            'guru_pendamping_id' => $request->guru_pendamping_id,
        ]);

        // Update user role to 'penjual'
        $user = $profile->user;
        
        // Sync roles using Spatie
        $user->syncRoles(['penjual']);
        
        // Update legacy role column if exists/used
        $user->update(['role' => 'penjual']);

        return redirect()->route('kepala_sekolah.verifikasi_penjual')->with('success', 'Penjual berhasil diverifikasi dan guru pendamping telah ditentukan.');
    }

    public function rejectPenjual($id)
    {
        $profile = PenjualProfile::findOrFail($id);
        $profile->update([
            'status_verifikasi' => 'rejected',
        ]);

        return redirect()->route('kepala_sekolah.verifikasi_penjual')->with('success', 'Pengajuan penjual ditolak.');
    }

    public function laporanPenjualanSiswa()
    {
        $sellers = User::role('penjual')
            ->with('penjualProfile')
            ->select('users.*')
            ->selectRaw('(SELECT COALESCE(SUM(order_items.quantity), 0) 
                FROM order_items 
                JOIN products ON products.id = order_items.product_id 
                JOIN orders ON orders.id = order_items.order_id 
                WHERE products.user_id = users.id 
                AND orders.status IN ("paid", "shipped", "completed")) as total_sold')
            ->selectRaw('(SELECT COALESCE(SUM(order_items.quantity * order_items.price), 0) 
                FROM order_items 
                JOIN products ON products.id = order_items.product_id 
                JOIN orders ON orders.id = order_items.order_id 
                WHERE products.user_id = users.id 
                AND orders.status IN ("paid", "shipped", "completed")) as total_revenue')
            ->get();

        return view('kepala_sekolah.laporan.penjualan_siswa', compact('sellers'));
    }

    public function laporanPembelianSiswa()
    {
        $buyers = User::whereHas('orders', function($query) {
                $query->whereIn('status', ['paid', 'shipped', 'completed']);
            })
            ->select('users.*')
            ->withCount(['orders as total_purchases' => function($query) {
                $query->whereIn('status', ['paid', 'shipped', 'completed']);
            }])
            ->withSum(['orders as total_spent' => function($query) {
                $query->whereIn('status', ['paid', 'shipped', 'completed']);
            }], 'total_price')
            ->get();

        return view('kepala_sekolah.laporan.pembelian_siswa', compact('buyers'));
    }
}