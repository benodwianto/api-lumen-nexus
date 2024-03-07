<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        return response()->json($user);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // Validasi input
        $this->validate($request, [
            'no_hp' => 'numeric',
            'nama_lengkap' => 'required|unique:users,nama_lengkap,' . $id,
            'tgl_lahir' => 'required|date|date_format:d-m-Y|before_or_equal:today',
            'alamat' => 'required',
            'foto_profil' => 'mimes:jpeg,png,jpg|max:2048'
        ], [
            'no_hp.numeric' => 'Nomor HP harus berupa angka.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'nama_lengkap.unique' => 'Nama lengkap sudah digunakan.',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tgl_lahir.date' => 'Tanggal lahir harus dalam format tanggal yang valid.',
            'tgl_lahir.date_format' => 'Format tanggal lahir harus dd-mm-yyyy.',
            'tgl_lahir.before_or_equal' => 'Tanggal lahir tidak boleh lebih dari hari ini.',
            'alamat.required' => 'Alamat wajib diisi.',
            'foto_profil.mimes' => 'Format foto harus jpeg, png, atau jpg.',
            'foto_profil.max' => 'Ukuran foto tidak boleh lebih dari 2MB.'
        ]);


        // Update data user
        $user = User::find($id);
        if (!$user) {
            return response()->json(['status' => '404', 'pesan' => 'User tidak ditemukan'], 404);
        }

        $user->fill($request->only('alamat', 'no_hp', 'nama_lengkap', 'tgl_lahir'));

        // Cek apakah ada file foto di request
        if ($request->hasFile('foto_profil')) {
            $foto_profil = $request->file('foto_profil')->getClientOriginalName();
            $request->file('foto_profil')->move('img', $foto_profil);
            $user->foto_profil = url('foto_profil', $foto_profil);
        }

        if ($user->save()) {
            $hasil = ['status' => '200', 'pesan' => 'Data anda berhasil diperbarui'];
        } else {
            $hasil = ['status' => '400', 'pesan' => 'Data anda gagal diperbarui'];
        }

        return response()->json($hasil);
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
