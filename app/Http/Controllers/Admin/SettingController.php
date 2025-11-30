<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        // Get settings from cache or return empty array
        $settings = Cache::get('site_settings', [
            'site_name' => 'Marketplace Sekolah',
            'site_description' => 'Platform jual beli untuk siswa SMK',
            'contact_email' => '',
            'contact_phone' => '',
            'address' => '',
            'payment_cash' => true,
            'payment_transfer' => true,
            'bank_name' => '',
            'bank_account' => '',
            'bank_holder' => '',
            'instagram' => '',
            'facebook' => '',
            'whatsapp' => '',
        ]);

        return view('admin.setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Cache::get('site_settings', []);
        
        // Merge with new settings
        $settings = array_merge($settings, $request->except(['_token', '_method']));
        
        // Handle checkboxes (they won't be sent if unchecked)
        $settings['payment_cash'] = $request->has('payment_cash');
        $settings['payment_transfer'] = $request->has('payment_transfer');
        
        // Store in cache (persistent)
        Cache::forever('site_settings', $settings);

        return redirect()->back()->with('success', 'Pengaturan berhasil disimpan');
    }
}
