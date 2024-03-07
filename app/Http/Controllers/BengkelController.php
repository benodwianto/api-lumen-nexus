<?php

namespace App\Http\Controllers;

use App\Models\Coment;
use App\Models\Bengkel;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;

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

        $data_komentar = Coment::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $bengkel = $user->bengkel::all();
        $data_produk = product::Where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        return response()->json([
            'data_produk' => $data_produk,
            'data_bengkel' => $bengkel,
            'data_komentar' => $data_komentar
        ]);
    }

    public function rateBengkel(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $bengkel = Bengkel::findOrFail($id);
        $bengkel->rating = ($bengkel->rating * $bengkel->review_count + $request->rating) / ($bengkel->review_count + 1);
        $bengkel->review_count++;
        $bengkel->save();

        return response()->json([
            'message' => 'Rating berhasil ditambahkan',
            'data' => $bengkel
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showRatingAndComments($bengkel_id)
    {
        $bengkel = Bengkel::with('rate.user', 'coment.user')->find($bengkel_id);

        if (!$bengkel) {
            return response()->json(['message' => 'Bengkel not found'], 404);
        }

        return response()->json([
            'bengkel' => $bengkel,
        ]);
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
            'link_gmaps' => 'required',
            'nohp' => 'required|min:11|max:12',
        ]);

        $data = [
            'nama_bengkel' => $request->input('nama_bengkel'),
            'alamat' => $request->input('alamat'),
            'link_gmaps' => $request->input('link_gmaps'),
            'nohp' => $request->input('nohp'),
            'user_id' => Auth::id(),
        ];

        $data_bengkel = Bengkel::create($data);
        if ($data_bengkel) {
            $user = Auth::user();
            $user->status = 'Admin';
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

    public function sortBengkelByRating(Request $request, $bengkelId)
    {
        $sortBy = $request->input('sort_by'); // "highest_rating", "lowest_rating", "latest_rating"

        // Query bengkel berdasarkan ID
        $bengkel = Bengkel::findOrFail($bengkelId);

        // Query untuk mengurutkan rating bengkel
        $query = $bengkel->ratings();

        if ($sortBy == 'highest_rating') {
            $query->orderBy('rating', 'desc');
        } elseif ($sortBy == 'lowest_rating') {
            $query->orderBy('rating', 'asc');
        } elseif ($sortBy == 'latest_rating') {
            $query->orderBy('created_at', 'desc');
        }

        // Ambil data rating bengkel
        $ratings = $query->get();

        return response()->json([
            'bengkel' => $bengkel,
            'ratings' => $ratings,
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bengkel  $bengkel
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        // Mencari semua produk yang dimiliki oleh pengguna dengan ID yang diberikan
        $products = Product::where('user_id', $user_id)->get();

        if ($products->isEmpty()) {
            return response()->json(['message' => 'Tidak ada produk yang ditemukan untuk pengguna ini'], 404);
        }

        return response()->json($products);
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
        $this->validate($request, [
            'nama_bengkel' => 'unique:bengkels,nama_bengkel,' . $id,
            'foto_bengkel' => 'mimes:jpeg,png,jpg|max:1064',
            'jam_buka' => 'date_format:H:i',
            'jam_tutup' => 'date_format:H:i',
            'alamat' => '',
            'link_gmaps' => '',
            'nohp' => 'numeric|unique:bengkels,no_hp',
            'deskripsi' => 'min:30',
            'foto_galeri_1' => 'mimes:jpeg,png,jpg|max:1064',
            'foto_galeri_2' => 'mimes:jpeg,png,jpg|max:1064',
            'foto_galeri_3' => 'mimes:jpeg,png,jpg|max:1064',
            'foto_galeri_4' => 'mimes:jpeg,png,jpg|max:1064',
            'foto_galeri_5' => 'mimes:jpeg,png,jpg|max:1064',
            'foto_galeri_6' => 'mimes:jpeg,png,jpg|max:1064',
        ]);

        $bengkel = Bengkel::findOrFail($id);

        $bengkel->nama_bengkel = $request->input('nama_bengkel', $bengkel->nama_bengkel);
        $bengkel->alamat = $request->input('alamat', $bengkel->alamat);
        $bengkel->link_gmaps = $request->input('link_gmaps', $bengkel->link_gmaps);
        $bengkel->nohp = $request->input('nohp', $bengkel->nohp);
        $bengkel->deskripsi = $request->input('deskripsi', $bengkel->deskripsi);
        $bengkel->jam_buka = $request->input('jam_buka', $bengkel->jam_buka);
        $bengkel->jam_tutup = $request->input('jam_tutup', $bengkel->jam_tutup);

        // Upload foto bengkel jika ada
        if ($request->hasFile('foto_bengkel')) {
            $fotoBengkel = $request->file('foto_bengkel')->getClientOriginalName('foto_bengkel');
            $request->file('foto_bengkel')->move('galeri', $fotoBengkel);
            $bengkel->foto_bengkel = url('galeri', $fotoBengkel);
        }

        // Upload foto galeri jika ada
        for ($i = 1; $i <= 6; $i++) {
            $fieldName = 'foto_galeri_' . $i;
            if ($request->hasFile($fieldName)) {
                $fotoGaleri = $request->file($fieldName)->getClientOriginalName($fieldName);
                $request->file($fieldName)->move('galeri', $fotoGaleri);
                $bengkel->{$fieldName} = url('galeri', $fotoGaleri);
            }
        }

        $update_data = $bengkel->save();

        if ($update_data) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Data berhasil diperbarui',
            ];
        } else {
            $hasil = [
                'status' => '400',
                'pesan' => 'Data gagal diperbarui',
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
