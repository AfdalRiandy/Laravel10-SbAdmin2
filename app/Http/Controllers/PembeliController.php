<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembeliController extends Controller
{
    public function dashboard()
    {
        return view('pembeli.dashboard');
    }
}