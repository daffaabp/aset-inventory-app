<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('Superadmin')) {
            return view('home_superadmin');
        }

        if ($user->hasRole('Petugas')) {
            return view('home_petugas');
        }

        if ($user->hasRole('Sekretaris Bidang')) {
            return view('home_sekretaris_bidang');
        }

        if ($user->hasRole('Sekretaris Kwarcab')) {
            return view('home_sekretaris_kwarcab');
        }
    }
}