<?php

namespace App\Transformers;

use App\Kasus;
use League\Fractal\TransformerAbstract;

class KasusTransformer extends TransformerAbstract
{
    public function transform(Kasus $kasus)
    {
        return[
            'kasus_id'          => $kasus->kasus_id,
            'kasus_nama'        => $kasus->kasus_nama,
            'kasus_deksripsi'   => $kasus->kasus_deskripsi,
        ];
    }
}
