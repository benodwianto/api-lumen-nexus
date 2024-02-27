<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\login;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Email tidak ditemukan',
                'data' => null
            ], 404);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'message' => 'Password salah',
                'data' => null
            ], 401);
        }

        $token = Str::random(60);

        $user->update([
            'api-token' => $token,
        ]);

        return response()->json([
            'message' => 'Login sukses',
            'token' => $token,
            'data' => $user,
        ]);
    }


    public function index()
    {
        return response()->json([
            'pesan' => 'Login terlebih dahulu'
        ]);
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
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6',
        ]);

        $data = [
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => '0',
            'api-token' => '1234',
        ];

        // Enkripsi password menggunakan Hash::make()
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json($user);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(login $login, $id)
    {
        $user = User::findorFail($id);
        if ($user->img) {
            Storage::delete($user->foto_profil);
        }
        $hapus_user = User::where('id', $id)->delete();
        if ($hapus_user) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Data berhasi di dihapus',
            ];
        } else {
            $hasil = [
                'status' => '400',
                'pesan' => 'Data Gagal di dihapus',
            ];
        }

        return response()->json($hasil);
    }
}
