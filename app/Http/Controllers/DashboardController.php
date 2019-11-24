<?php

namespace App\Http\Controllers;

use App\Kasus;
use App\Kekerasan;
use App\Pengaduan;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $pengaduan      = Pengaduan::count();
        $user           = User::where('role', '1')->count();
        $kekerasan      = Kekerasan::count();
        $kasus          = Kasus::count();

        $kdrt           = Pengaduan::where('kasus_id', '1')->count();
        $anak           = Pengaduan::where('kasus_id', '2')->count();
        $perempuan      = Pengaduan::where('kasus_id', '3')->count();
        $perdagangan    = Pengaduan::where('kasus_id', '4')->count();
        $kerja          = Pengaduan::where('kasus_id', '5')->count();

        return view('master.dashboard', compact('pengaduan', 'user', 'kekerasan', 'kasus',
            'kdrt', 'anak', 'perempuan', 'perdagangan', 'kerja'));
    }
}
