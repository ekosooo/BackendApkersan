<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table       = 'pengaduan';
    protected $primaryKey  = 'pengaduan_id';
    protected $fillable    = [
      'pengaduan_id', 'user_id', 'kasus_id', 'kekerasan_id', 'ticker_number', 'status_pelapor',
      'disabilitas', 'korban_nama', 'korban_usia', 'korban_jk', 'korban_pendidikan', 'korban_bekerja',
      'korban_statuskawin', 'alamat_kejadian', 'waktu_kejadian', 'tempat_kejadian', 'kronologi',
      'bukti', 'ticket_number', 'status_pengaduan', 'lat', 'lng',
    ];
}
