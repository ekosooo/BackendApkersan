<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    //
    public function index()
    {
        $peta = DB::table('pengaduan')
            ->join('user', 'pengaduan.user_id', '=', 'user.user_id')
            ->join('kasus', 'pengaduan.kasus_id', '=', 'kasus.kasus_id')
            ->join('kekerasan', 'pengaduan.kekerasan_id', '=', 'kekerasan.kekerasan_id')
            ->select('ticket_number', 'korban_nama', 'kasus_nama', 'kekerasan_nama', 'lat', 'lng', 'status_pengaduan')
            ->get();

        return view('map.index', compact('peta'));
    }
}
