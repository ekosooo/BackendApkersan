<?php

namespace App\Transformers;

use App\Pengaduan;
use League\Fractal\TransformerAbstract;

class PengaduanTransformer extends TransformerAbstract
{
    public function transform(Pengaduan $pengaduan)
    {
        return[
            'user_id'           => $pengaduan->user_id,
            'kasus_id'          => $pengaduan->kasus_id,
            'kekerasan_id'      => $pengaduan->ticket_number,
            'status_pelapor'    => $pengaduan->status_pelapor,
            'disabilitas'       => $pengaduan->disabilitas,
            'korban_nama'       => $pengaduan->korban_nama,
            'korban_jk'         => $pengaduan->korban_jk,
            'korban_usia'       => $pengaduan->korban_usia,
            'korban_pendidikan' => $pengaduan->korban_pendidikan,
            'korban_bekerja'    => $pengaduan->korban_bekerja,
            'korban_statuskawin'=> $pengaduan->korban_statuskawin,
            'alamat_kejadian'   => $pengaduan->alamat_kejadian,
            'krnologi'          => $pengaduan->kronologi,
            'bukti'             => $pengaduan->bukti,
        ];
    }
}