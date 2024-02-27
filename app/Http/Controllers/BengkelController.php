<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BengkelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $data_produk = product::Where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();

        return response()->json($data_produk);
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_bengkel' => 'required|unique:bengkels,nama_bengkel',
            'alamat' => 'required',
            'nohp' => ['required', 'numeric', 'regex:/^08\d{9,10}$/'],
        ]);

        $data = [
            'nama_bengkel' => $request->input('nama_bengkel'),
            'alamat' => $request->input('alamat'),
            'nohp' => $request->input('nohp'),
        ];

        // $data['kategori_id'] =

        $data_bengkel = Bengkel::create($data);
        if ($data_bengkel) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Berhasil Mendaftar mitra',
                'data_bengkel' => $data_bengkel
            ];
        } else {
            $hasil = [
                'status' => '400',
                'pesan' => 'Gagal Mendaftar mitra',
                'data_bengkel' => $data_bengkel
            ];
        }

        return response()->json($hasil);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bengkel  $bengkel
     * @return \Illuminate\Http\Response
     */
    public function show(Bengkel $bengkel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bengkel  $bengkel
     * @return \Illuminate\Http\Response
     */
    public function edit(Bengkel $bengkel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bengkel  $bengkel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bengkel $bengkel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bengkel  $bengkel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bengkel $bengkel)
    {
        //
    }
}
