<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kekerasan extends Model
{
    protected $primaryKey = 'kekerasan_id';
    protected $table      = 'kekerasan';
    protected $fillable   = [
      'kekerasan_id', 'kekerasan_nama', 'kekerasan_deskripsi',
    ];
}
