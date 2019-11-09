<?php

namespace App\Transformers;

use App\Kekerasan;
use League\Fractal\TransformerAbstract;

class KekerasanTransformer extends TransformerAbstract
{
    public function transform(Kekerasan $kekerasan)
    {
        return[
          'kekerasan_id'        => $kekerasan->kekerasan_id,
          'kekerasan_nama'      => $kekerasan->kekerasan_nama,
          'kekerasan_deksripsi' => $kekerasan->kekerasan_deskripsi,
        ];
    }
}