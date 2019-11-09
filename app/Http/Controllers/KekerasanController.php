<?php

namespace App\Http\Controllers;

use App\Kekerasan;
use App\Transformers\KekerasanTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KekerasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kekerasan = DB::table('kekerasan')
            ->orderBy('kekerasan_nama', 'ASC')
            ->paginate(5);

        return view('kekerasan.index', compact('kekerasan'))
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
    public function store(Request $request, Kekerasan $kekerasan)
    {
        $kekerasan->create([
            'kekerasan_nama'         => $request->kekerasan_nama,
            'kekerasan_deskripsi'    => $request->kekerasan_deskripsi,
        ]);

        return redirect('/kekerasan')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kekerasan = DB::table('kekerasan')
            ->where('kekerasan_id', '=', $id)
            ->get();

        return view('kekerasan.edit', compact('kekerasan'));
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
        $kekerasan = Kekerasan::find($id);
        $kekerasan->update([
           'kekerasan_nama'         => $request->kekerasan_nama,
           'kekerasan_deskripsi'    => $request->kekerasan_deskripsi,
        ]);

        return redirect('/kekerasan')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $kekerasan = Kekerasan::findOrFail($request->kekerasan_id);
        $kekerasan->delete();

        return redirect('/kekerasan')->with('success', 'Data berhasil dihapus');
    }

    public function pindah()
    {
        return view('kekerasan.create');
    }

    //controller APi
    public function kekerasan(Kekerasan $kekerasan)
    {
        $kekerasan = $kekerasan->orderBy('kekerasan_nama', 'ASC')
            ->get();

        $response = fractal()
            ->collection($kekerasan)
            ->transformWith(new KekerasanTransformer)
            ->toArray();

            return response()->json($response, 201);
    }
}
