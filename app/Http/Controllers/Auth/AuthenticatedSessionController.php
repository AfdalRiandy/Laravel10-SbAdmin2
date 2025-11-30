<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.custom-login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            $request->authenticate();
            
            $request->session()->regenerate();

            // Redirect based on user role
            $user = Auth::user();
            
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('penjual')) {
                return redirect()->route('seller.dashboard');
            } elseif ($user->hasRole('kepala_sekolah')) {
                return redirect()->route('kepala_sekolah.dashboard');
            } elseif ($user->hasRole('guru_pendamping')) {
                return redirect()->route('guru_pendamping.dashboard');
            } elseif ($user->hasRole('pembeli')) {
                return redirect()->route('pembeli.dashboard');
            }

            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            return back()->withErrors([
                'credential' => 'The provided credentials do not match our records.',
            ])->withInput($request->except('password'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}