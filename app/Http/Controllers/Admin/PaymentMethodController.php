<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethod::latest()->get();
        return view('admin.payment-method.index', compact('paymentMethods'));
    }

    public function create()
    {
        return view('admin.payment-method.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'holder' => 'required|string|max:255',
            'type' => 'required|in:transfer,cod,ewallet',
            'is_active' => 'boolean',
        ]);

        PaymentMethod::create($request->all());

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil ditambahkan');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        return view('admin.payment-method.edit', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'holder' => 'required|string|max:255',
            'type' => 'required|in:transfer,cod,ewallet',
            'is_active' => 'boolean',
        ]);

        $paymentMethod->update($request->all());

        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil diperbarui');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        return redirect()->route('admin.payment-methods.index')
            ->with('success', 'Metode pembayaran berhasil dihapus');
    }
}
