<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use App\Transformers\PengaduanTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{

    public function index()
    {
        $pengaduan = DB::table('pengaduan')
            ->join('user', 'pengaduan.user_id', '=', 'user.user_id')
            ->join('kasus', 'pengaduan.kasus_id', '=', 'kasus.kasus_id')
            ->join('kekerasan', 'pengaduan.kekerasan_id', '=', 'kekerasan.kekerasan_id')
            ->select('ticket_number', 'user_nama', 'kasus_nama', 'kekerasan_nama', 'pengaduan_id', 'status_pengaduan')
            ->orderBy('pengaduan_id', 'DESC')
            ->paginate(5);

        return view('pengaduan.index', compact('pengaduan'))
            ->with('i', (request()->input('page', 1)-1)*5);
    }

    public function detail($id)
    {
        $pengaduan = DB::table('pengaduan')
            ->join('user', 'pengaduan.user_id', '=', 'user.user_id')
            ->join('kasus', 'pengaduan.kasus_id', '=', 'kasus.kasus_id')
            ->join('kekerasan', 'pengaduan.kekerasan_id', '=', 'kekerasan.kekerasan_id')
            ->where('pengaduan_id', '=', $id)
            ->get();

        return view('pengaduan.edit', compact('pengaduan'));
    }


    //api
    public function store(Request $request, Pengaduan $pengaduan)
    {

        if ($request->bukti != null){
            $time = time();
            $entry = base64_decode($request->bukti);
            $img = imagecreatefromstring($entry);
            $directory = public_path('bukti/'.$time.".jpg");
            imagejpeg($img, $directory);
            imagedestroy($img);
//            $bukti  = $request->file('bukti');
//            $nama = $bukti->getClientOriginalName();
//            $destination = public_path('bukti/');
//            $bukti->move($destination, $nama);

            $pengaduan = $pengaduan->create([
                'ticket_number'     => $request->ticket_number,
                'user_id'           => $request->user_id,
                'kasus_id'          => $request->kasus_id,
                'kekerasan_id'      => $request->kekerasan_id,
                'status_pelapor'    => $request->status_pelapor,
                'disabilitas'       => $request->disabilitas,
                'korban_nama'       => $request->korban_nama,
                'korban_jk'         => $request->korban_jk,
                'korban_usia'       => $request->korban_usia,
                'korban_pendidikan' => $request->korban_pendidikan,
                'korban_bekerja'    => $request->korban_bekerja,
                'korban_statuskawin'=> $request->korban_statuskawin,
                'alamat_kejadian'   => $request->alamat_kejadian,
                'waktu_kejadian'    => $request->waktu_kejadian,
                'tempat_kejadian'   => $request->tempat_kejadian,
                'kronologi'         => $request->kronologi,
                'bukti'             => $time.".jpg",
                'lat'               => $request->lat,
                'lng'               => $request->lng,
                'status_pengaduan'  => $request->status_pengaduan,
            ]);
        }else{
            $pengaduan = $pengaduan->create([
                'ticket_number'     => $request->ticket_number,
                'user_id'           => $request->user_id,
                'kasus_id'          => $request->kasus_id,
                'kekerasan_id'      => $request->kekerasan_id,
                'status_pelapor'    => $request->status_pelapor,
                'disabilitas'       => $request->disabilitas,
                'korban_nama'       => $request->korban_nama,
                'korban_jk'         => $request->korban_jk,
                'korban_usia'       => $request->korban_usia,
                'korban_pendidikan' => $request->korban_pendidikan,
                'korban_bekerja'    => $request->korban_bekerja,
                'korban_statuskawin'=> $request->korban_statuskawin,
                'alamat_kejadian'   => $request->alamat_kejadian,
                'waktu_kejadian'    => $request->waktu_kejadian,
                'tempat_kejadian'   => $request->tempat_kejadian,
                'kronologi'         => $request->kronologi,
                'lat'               => $request->lat,
                'lng'               => $request->lng,
                'status_pengaduan'  => $request->status_pengaduan,
            ]);
        }

        $response = fractal()
            ->item($pengaduan)
            ->transformWith(new PengaduanTransformer)
            ->toArray();

        $message = [
          'error' => 'false',
        ];

        return response()->json($message+$response, 201);
    }
}
