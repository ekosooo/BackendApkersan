<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransfomer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function RegisterUser(Request $request, User $user)
    {
        $user = $user->create([
            'user_nama'         => $request->user_nama,
            'user_jk'           => $request->user_jk,
            'user_email'        => $request->user_email,
            'user_phone'        => $request->user_phone,
            'password'          => bcrypt($request->password),
            'user_alamat'       => $request->user_alamat,
            'role'              => '1',
        ]);

        $response = fractal()
            ->item($user)
            ->transformWith(new UserTransfomer)
            ->toArray();

        return response()->json($response, 201);
    }

    public function LoginUser(Request $request, User $user)
    {

        if (!Auth::attempt([
            'user_email'        => $request->user_email,
            'password'          => $request->password,
        ])){
            return response()->json(['error' => 'Email atau password salah', 401]);
        }

        $user = $user->find(Auth::user()->user_id);

        $response = fractal()
            ->item($user)
            ->transformWith(new UserTransfomer)
            ->toArray();

        $message = [
            "error" => 'false',
        ];

        return response()->json($message+$response, 201);
    }
}
