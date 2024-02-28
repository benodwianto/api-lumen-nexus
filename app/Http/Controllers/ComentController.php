<?php

namespace App\Http\Controllers;

use App\Models\Coment;
use Illuminate\Http\Request;

class ComentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, $productId)
    {
        // Validasi input
        $this->validate($request, [
            'komentar' => 'required|string|max:255',
        ]);

        $data = [
            'user_id' => auth()->user()->id,
            'product_id' => $productId,
            'komentar' => $request->input('komentar')
        ];

        $komen = Coment::create($data);
        if ($komen) {
            $hasil_komen = [
                'pesan' => 'Komen ditambahkan',
                'data' => $data,
            ];
        }

        // Response berhasil
        return response()->json(['message' => 'Komentar berhasil ditambahkan', 'komen' => $hasil_komen], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coment  $coment
     * @return \Illuminate\Http\Response
     */
    public function show(Coment $coment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coment  $coment
     * @return \Illuminate\Http\Response
     */
    public function edit(Coment $coment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coment  $coment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coment $coment, $id)
    {
        $update_data = Coment::where('id', $id)->update($request->all());

        if ($update_data) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Komen berhasi di perbarui',
            ];
        } else {
            $hasil = [
                'pesan' => 'Komen Gagal di perbarui', 400
            ];
        }

        return response()->json($hasil);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coment  $coment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coment $coment, $id)
    {
        $hapus_komen = Coment::destroy($id);

        if ($hapus_komen) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Komentar berhasil dihapus',
            ];
        } else {
            $hasil = [
                'status' => '400',
                'pesan' => 'Komentar gagal dihapus',
            ];
        }

        return response()->json($hasil);
    }
}
