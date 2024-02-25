<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        return response()->json($data);
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
        $this->validate($request, [
            'no_hp' => ['required', 'numeric', 'regex:/^08\d{9,10}$/'],
            'nama_lengkap' => 'required|unique:users',
            'tgl_lahir' => 'date',
            'email' => 'unique:users',
            'foto_profil' => 'mimes:jpeg,png,jpg|max:2048'

        ]);
        $update_user = User::where('id', $id)->update($request->only('no_hp', 'nama_lengkap', 'tgl_lahir', 'email', 'foto_profil'));
        if ($update_user) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Data anda berhasi di perbarui',
            ];
        } else {
            $hasil = [
                'status' => '400',
                'pesan' => 'Data anda Gagal di perbarui',
            ];
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
