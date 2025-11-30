<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class GuruPendampingController extends Controller
{
    public function dashboard()
    {
        $totalStudents = User::role('penjual')->count();
        return view('guru_pendamping.dashboard', compact('totalStudents'));
    }

    public function students()
    {
        $students = User::role('penjual')->with('penjualProfile')->get();
        return view('guru_pendamping.students.index', compact('students'));
    }

    public function salesReport()
    {
        return view('guru_pendamping.reports.sales');
    }
}
