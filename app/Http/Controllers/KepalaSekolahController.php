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
        
        return view('kepala_sekolah.dashboard', compact('pendingVerifications', 'activeSellers', 'totalStudents'));
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
}