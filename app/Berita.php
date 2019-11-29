<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table        = 'berita';
    protected $primaryKey   = 'berita_id';
    protected $fillable     = [
        'judul_berita', 'konten_berita', 'gambar', 'penulis_berita',
    ];
}
