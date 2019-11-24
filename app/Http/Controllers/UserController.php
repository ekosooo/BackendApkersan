<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransfomer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //controller admin
    public function create()
    {
        return view('akun.admin.create');
    }

    public function RegisterAdmin(Request $request, User $admin)
    {
        $this->validate($request,[
            'user_email'    => 'required|unique:user',
            'password'      => 'required|digits:6',
        ]);

        $admin->create([
            'user_nama'         => $request->user_nama,
            'user_jk'           => $request->user_jk,
            'user_email'        => $request->user_email,
            'user_phone'        => $request->user_phone,
            'password'          => bcrypt($request->password),
            'user_alamat'       => $request->user_alamat,
            'role'              => '0',
        ]);

        return redirect('/admin')->with('success', 'Data berhasil ditambahkan');
    }

    public function indexAdmin()
    {
        $admin = DB::table('user')
            ->where('role', '=', '0')
            ->paginate(5);

        return view('akun.admin.index', compact('admin'))
            ->with('i', (request()->input('page', 1)-1)*5);
    }

    public function showAdmin($id)
    {
        $admin = DB::table('user')
            ->where('user_id', '=', $id)
            ->get();

        return view('akun.admin.edit', compact('admin'));
    }

    public function updateAdmin(Request $request, $id)
    {
        $admin = User::find($id);
        $admin->update([
            'user_nama'         => $request->user_nama,
            'user_jk'           => $request->user_jk,
            'user_email'        => $request->user_email,
            'user_phone'        => $request->user_phone,
            'user_alamat'       => $request->user_alamat,
        ]);

        return redirect('/admin')->with('success', 'Data berhasil diupdate');
    }

    public function destroyAdmin(Request $request){
        $admin = User::find($request->user_id);
        $admin->delete();

        return redirect('/admin')->with('success', 'Data berhasil dihapus');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }

    //controller user
    public function indexPengguna()
    {
        $pengguna = DB::table('user')
            ->where('role', '=', '1')
            ->paginate(5);

        return view('akun.user.index', compact('pengguna'))
            ->with('i', (request()->input('page', 1)-1)*5);
    }

    public function showPengguna($id)
    {
        $pengguna = DB::table('user')
            ->where('user_id', '=', $id)
            ->get();

        return view('akun.user.edit', compact('pengguna'));
    }

    //login admin
    public function login()
    {
        return view('login');
    }

    public function LoginAdmin(Request $request)
    {
        if (Auth::attempt([
            'user_email'        => $request->email,
            'password'          => $request->password,
            'role'              => $request->role,
        ])){
            return redirect('/');
        }else{
            return redirect('/login');
        }
    }

    //token push notif android (API)
    public function SaveTokenFCM(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'fcm_token'      => $request->fcm_token,
        ]);

        return response()->json($user, 201);
    }

    //API
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

    //login user API
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

    //update profile API
    public function updateProfile(Request $request, $id)
    {
        $user = USER::find($id);
        $user->update([
            'user_nama'      => $request->user_nama,
            'user_alamat'    => $request->user_alamat,
            'user_phone'     => $request->user_phone,
            'user_email'     => $request->user_email
        ]);

        $message = [
            "eror"      => "false",
            "data"      => $user,
        ];

        return response()->json($message, 201);
    }


}
