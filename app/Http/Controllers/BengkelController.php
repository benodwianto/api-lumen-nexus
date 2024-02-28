<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        $data_produk = product::Where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

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
            'nohp' => 'numeric'
        ]);

        $data = [
            'nama_bengkel' => $request->input('nama_bengkel'),
            'alamat' => $request->input('alamat'),
            'nohp' => $request->input('nohp'),
            'id_user' => Auth::id(),
        ];

        $data_bengkel = Bengkel::create($data);
        if ($data_bengkel) {
            $user = Auth::user();
            $user->status = 1;
            $user->save();

            $hasil = [
                'status' => '200',
                'pesan' => 'Berhasil Mendaftar mitra',
                'data_bengkel' => $data_bengkel,
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
    public function update(Request $request, $id)
    {
        $update_data = Product::where('id', $id)->update($request->all());

        if ($update_data) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Data berhasi di perbarui',
            ];
        } else {
            $hasil = [
                'pesan' => 'Data Gagal di perbarui', 400
            ];
        }

        return response()->json($hasil);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bengkel  $bengkel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bengkel $bengkel, $id)
    {
        $produk = Bengkel::findOrFail($id);

        $fields = ['foto_bengkel', 'foto-galeri-1', 'foto-galeri-2', 'foto-galeri-3', 'foto-galeri-4', 'foto-galeri-5', 'foto-galeri-6']; // Ganti dengan nama field sesuai dengan struktur tabel Anda

        // Hapus file gambar dari setiap field
        foreach ($fields as $field) {
            $filename = 'img/' . $produk->$field;
            if ($produk->$field && file_exists($filename)) {
                unlink($filename); // Hapus file dari penyimpanan
            }
        }
        // Hapus produk dari database
        $hapus_produk = product::destroy($id);

        if ($hapus_produk) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Data berhasil dihapus',
            ];
        } else {
            $hasil = [
                'status' => '400',
                'pesan' => 'Data gagal dihapus',
            ];
        }

        return response()->json($hasil);
    }
}
