<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruPendampingController extends Controller
{
    public function dashboard()
    {
        return view('guru_pendamping.dashboard');
    }
}