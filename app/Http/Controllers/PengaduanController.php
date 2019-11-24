<?php

namespace App\Http\Controllers;

use App\Pengaduan;
use App\Transformers\PengaduanTransformer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Notification;

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

    public function detail($id, Request $request)
    {
        $pengaduan = DB::table('pengaduan')
            ->join('user', 'pengaduan.user_id', '=', 'user.user_id')
            ->join('kasus', 'pengaduan.kasus_id', '=', 'kasus.kasus_id')
            ->join('kekerasan', 'pengaduan.kekerasan_id', '=', 'kekerasan.kekerasan_id')
            ->where('pengaduan_id', '=', $id)
            ->get();

        //markAs read
        $notification = auth()->user()->notifications()->find($request->notif_id);

        if ($notification == null){
        }else if($notification){
            $notification->markAsRead();
        }

        return view('pengaduan.edit', compact('pengaduan'));
    }

    public function verifikasi(Request $request, $id)
    {
        $pengaduan = Pengaduan::find($id);
        $pengaduan->update([
            'status_pengaduan'  => $request->status_pengaduan,
            'tindak_lanjut'     => $request->tindak_lanjut,
        ]);

        //fcm
        define('API_ACCESS_KEY','AAAAmX86oHs:APA91bGxOqmfOQVeNx0WxoaPlG7S-TqFQ-OM8rxdaQnt_in_REvbJPzQuEXpzzQnkEnF0KPfO1WNJHmGCZ-LKOLqoXVCcQVgsToxB4i-ZtYqkWB22NrLp_OUhBdM0Rqp3sTjZIZ8GPVv');
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        $token=($request->fcm_token);

        $notification = [
            'title' =>'Apkersan',
            'body' => 'Pengaduan dengan no tiket ' .$request->ticket_number. ' Jenis kasus '.$request->kasus_nama. ' status '.$request->status_pengaduan,
        ];
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        ];


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        curl_exec($ch);
        curl_close($ch);

        return redirect('/pengaduan')->with('success', 'Data berhasil diverifikasi');
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

        //notifikasi untuk admin
        $users = User::where('role', 0)->get();
        foreach ($users as $user) {
            Notification::send($user, new \App\Notifications\NewPengaduan($user, $pengaduan));
        }

        return response()->json($message+$response, 201);
    }

    public function show($id)
    {
        $pengaduan = DB::table('pengaduan')
            ->join('user', 'pengaduan.user_id', '=', 'user.user_id')
            ->join('kasus', 'pengaduan.kasus_id', '=', 'kasus.kasus_id')
            ->join('kekerasan', 'pengaduan.kekerasan_id', '=', 'kekerasan.kekerasan_id')
            ->where('pengaduan.user_id', '=', $id)
            ->select('pengaduan_id', 'kasus_nama', 'kekerasan_nama', 'ticket_number',
                'korban_nama', 'alamat_kejadian', 'waktu_kejadian', 'kronologi', 'bukti',
                'status_pengaduan', 'tindak_lanjut', 'pengaduan.created_at')
            ->orderBy("pengaduan_id", "DESC")
            ->get();

        $aduan          = Pengaduan::where('status_pengaduan', 'Menunggu')->where('user_id', $id)->count();
        $ditolak        = Pengaduan::where('status_pengaduan', 'Ditolak')->where('user_id', $id)->count();
        $diterima       = Pengaduan::where('status_pengaduan', 'Diterima')->where('user_id', $id)->count();


        $data = [
            'error'     => 'false',
            'aduan'     => $aduan,
            'diterima'  => $diterima,
            'ditolak'   => $ditolak,
            'data'      => $pengaduan
        ];

        return response()->json($data, 201);
    }


}
