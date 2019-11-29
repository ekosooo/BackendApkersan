<?php

namespace App\Http\Controllers;

use App\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = DB::table('berita')
            ->orderBy('berita_id', 'DESC')
            ->select('berita_id', 'judul_berita', 'konten_berita', 'penulis_berita')
            ->paginate(5);

        return view('berita.index', compact('berita'))
            ->with('i', (request()->input('page', 1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('berita.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Berita $berita)
    {

        if ($request->hasFile('gambar')){
            $img        = $request->file('gambar');
            $name       = time().'.'.$img->getClientOriginalExtension();
            $detination = public_path('/berita/');
            $img->move($detination, $name);
        }

        $penulis = Auth::user()->user_nama;

        $berita->create([
            'judul_berita'       => $request->judul_berita,
            'konten_berita'      => $request->konten_berita,
            'penulis_berita'     => $penulis,
            'gambar'             => $name,
        ]);

        return redirect('/berita/index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $berita = DB::table('berita')
            ->where('berita_id', '=', $id)
            ->get();

        return view('berita.edit', compact('berita'));
//        return view('berita.edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::find($id);
        $berita->update([
           'judul_berita'       => $request->judul_berita,
           'konten_berita'      => $request->konten_berita,
        ]);

        return redirect('/berita/index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $berita = Berita::find($request->berita_id);
        $berita->delete();

        return redirect('/berita/index')->with('success', 'Data berhasil dihapus');
    }

    //api
    public function berita()
    {
        $berita = DB::table('berita')
            ->orderBy('berita_id', 'DESC')
            ->select('berita_id', 'judul_berita', 'konten_berita', 'penulis_berita', 'gambar', 'created_at')
            ->get();

        $message = [
          'error'   => 'false',
          'data'    => $berita
        ];

        return response()->json($message, 201);
    }

}
