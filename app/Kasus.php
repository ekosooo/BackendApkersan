<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    protected $primaryKey   = 'kasus_id';
    protected $table        = 'kasus';
    protected $fillable     = [
      'kasus_id', 'kasus_nama', 'kasus_deskripsi',
    ];
}
