<?php

namespace App\Http\Controllers;

use App\Kasus;
use App\Transformers\KasusTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kasus = DB::table('kasus')
            ->orderBy('kasus_nama', 'ASC')
            ->paginate(5);

        return view('kasus.index', compact('kasus'))
            ->with('i', (request()->input('page', 1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Kasus $kasus)
    {
        $kasus->create([
            'kasus_nama'         => $request->kasus_nama,
            'kasus_deskripsi'   => $request->kasus_deskripsi,
        ]);

        return redirect('/kasus')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kasus = DB::table('kasus')
            ->where('kasus_id', '=', $id)
            ->get();

        return view('kasus.edit', compact('kasus'));
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
        $kasus = Kasus::find($id);
        $kasus->update([
           'kasus_nama'     => $request->kasus_nama,
           'kasus_deskripsi'=> $request->kasus_deskripsi,
        ]);

        return redirect('/kasus')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $kasus = Kasus::findOrFail($request->kasus_id);
        $kasus->delete();

        return redirect('/kasus')->with('success', 'Data berhasil dihapus');
    }

    public function pindah()
    {
        return view('kasus.create');
    }

    //controller API
    public function kasus(Kasus $kasus)
    {
        $kasus = $kasus->orderBy('kasus_nama', 'ASC')
            ->get();

        $response = fractal()
            ->collection($kasus)
            ->transformWith(new KasusTransformer)
            ->toArray();
        return response()->json($response, 201);
    }
}
