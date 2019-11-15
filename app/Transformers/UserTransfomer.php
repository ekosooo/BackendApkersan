<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransfomer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return[
            'user_id'           => $user->user_id,
            'user_nama'         => $user->user_nama,
            'user_jk'           => $user->user_jk,
            'user_email'        => $user->user_email,
            'user_phone'        => $user->user_phone,
            'user_alamat'       => $user->user_alamat,
            'role'              => $user->role,
        ];
    }
}
