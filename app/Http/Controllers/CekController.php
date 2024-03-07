<?php

namespace App\Http\Controllers;

use App\Models\Cek;
use App\Models\Bengkel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $semua_riwayat_cek = Cek::where('user_id', $user->id)->get();

        return response()->json($semua_riwayat_cek);
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
        $validator = Validator::make($request->all(), [
            'km_sebelum' => 'required|numeric',
            'km_sekarang' => 'required|numeric|different:km_sebelum',
            'jenis_motor' => 'required|in:Matic,Manual,Kopling',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data yang dikirim tidak valid',
                'errors' => $validator->errors()
            ], 422);
        }

        $km_sebelum = $request->input('km_sebelum');
        $km_sekarang = $request->input('km_sekarang');
        $jenis_motor = $request->input('jenis_motor');

        $data = [
            'km_sebelum' => $km_sebelum,
            'km_sekarang' => $km_sekarang,
            'jenis_motor' => $jenis_motor,
        ];

        if ($jenis_motor == 'Matic') {
            $perbedaan_km = $km_sekarang - $km_sebelum;
            if ($perbedaan_km < 2000) {
                $rekomendasi = 'Tidak perlu perbaikan';
                $keterangan = 'Motor masih dalam kondisi baik.';
            } elseif ($perbedaan_km >= 2000 && $perbedaan_km < 4000) {
                $rekomendasi = 'Ganti Oli Mesin';
                $harga = '50.000-100.000';
                $keterangan = 'Oli mesin memiliki tiga fungsi utama, yakni sebagai pelumas, pelindung, dan pendingin. Mengingat keberadaannya yang sangat vital maka harus mendapat perhatian secara serius. Mengganti oli mesin sesuai dengan jadwal wajib hukumnya biar mesin motor awet.';
            } elseif ($perbedaan_km >= 4000 && $perbedaan_km < 6000) {
                $rekomendasi = 'Ganti Busi';
                $harga = '50.000-100.000';
                $keterangan = 'Setiap mesin pembakaran internal membutuhkan pengapian untuk menunjang kerjanya. Hal tersebut menjadi tugas dari busi yang berfungsi mengubah aliran listrik dari koil menjadi percikan api. Selain memiliki fungsi yang sangat penting, kondisi busi juga mencerminkan “kesehatan” mesin motor. Utamanya terkait campuran antara udara dan bensin yang masuk ke ruang bakar.';

                // Pesan tambahan jika belum mengganti oli mesin
                $keterangan .= ' Juga, disarankan untuk mengganti oli mesin karena usia oli mesin telah mencapai batasnya. Harga estimasi untuk penggantian oli adalah Rp 50.000-100.000.';
            } elseif ($perbedaan_km >= 6000 && $perbedaan_km < 8000) {
                $rekomendasi = 'Ganti Oli Gardan';
                $harga = '15.000-30.000';
                $keterangan = 'Oli gardan berfungsi melumasi gir-gir yang berada di dalam rumah CVT. Sejumlah pabrikan menyarankan penggantian oli gardan dilakukan setiap 8.000 km. Tapi jangan tunggu sampai interval maksimum. Terlebih lagi jika motor sering diajak bermacet-macetan.';
            } elseif ($perbedaan_km >= 8000 && $perbedaan_km < 10000) {
                $rekomendasi = 'Ganti Kampas Rem';
                $harga = '60.000-120.000';
                $keterangan = 'Pastikan kondisi kampas rem dalam kondisi layak pakai. Itu artinya kampas rem masih memiliki ketebalan yang ideal untuk bergesekan dengan cakram atau tromol. Jangan tunda penggantian seandainya diperlukan.';
            } else {
                $rekomendasi = 'Lakukan Servis ke tempat Servis Resmi';
                $harga = '60.000-160.000';
                $keterangan = 'Jika kamu tidak melakukan servis motor berkala, maka kemungkinan akan banyak yang diperiksa, pastikan budget yang kamu bawa berlebih.';
            }
        } elseif ($jenis_motor == 'Manual' or 'Kopling') {
            $perbedaan_km = $km_sekarang - $km_sebelum;
            if ($perbedaan_km < 2000) {
                $rekomendasi = 'Tidak perlu perbaikan';
                $keterangan = 'Motor masih dalam kondisi baik.';
            } elseif ($perbedaan_km >= 2000 && $perbedaan_km < 4000) {
                $rekomendasi = 'Ganti Oli Mesin';
                $harga = '50.000-100.000';
                $keterangan = 'Oli mesin memiliki tiga fungsi utama, yakni sebagai pelumas, pelindung, dan pendingin. Mengingat keberadaannya yang sangat vital maka harus mendapat perhatian secara serius. Mengganti oli mesin sesuai dengan jadwal wajib hukumnya biar mesin motor awet.';
            } elseif ($perbedaan_km >= 4000 && $perbedaan_km < 6000) {
                $rekomendasi = 'Ganti Busi';
                $harga = '50.000-100.000';
                $keterangan = 'Setiap mesin pembakaran internal membutuhkan pengapian untuk menunjang kerjanya. Hal tersebut menjadi tugas dari busi yang berfungsi mengubah aliran listrik dari koil menjadi percikan api. Selain memiliki fungsi yang sangat penting, kondisi busi juga mencerminkan “kesehatan” mesin motor. Utamanya terkait campuran antara udara dan bensin yang masuk ke ruang bakar.';

                // Pesan tambahan jika belum mengganti oli mesin
                $keterangan .= ' Juga, disarankan untuk mengganti oli mesin karena usia oli mesin telah mencapai batasnya. Harga estimasi untuk penggantian oli adalah Rp 50.000-100.000.';
            } elseif ($perbedaan_km >= 6000 && $perbedaan_km < 8000) {
                $rekomendasi = 'Ganti Busi';
                $harga = '50.000-100.000';
                $keterangan = 'Setiap mesin pembakaran internal membutuhkan pengapian untuk menunjang kerjanya. Hal tersebut menjadi tugas dari busi yang berfungsi mengubah aliran listrik dari koil menjadi percikan api. Selain memiliki fungsi yang sangat penting, kondisi busi juga mencerminkan “kesehatan” mesin motor. Utamanya terkait campuran antara udara dan bensin yang masuk ke ruang bakar.';

                // Pesan tambahan jika belum mengganti oli mesin
                // $keterangan .= ', disarankan untuk mengganti oli mesin karena usia oli mesin telah mencapai batasnya. Harga estimasi untuk penggantian oli adalah Rp 50.000-100.000.';
            } elseif ($perbedaan_km >= 8000 && $perbedaan_km < 10000) {
                $rekomendasi = 'Ganti Filter Udara';
                $harga = '60.000-100.000';
                $keterangan = 'Hal penting lainnya dalam perawatan motor ialah memerhatikan kondisi filter udara. Komponen ini berfungsi untuk menyaring udara yang masuk ke dalam pembakaran. Sangat berguna untuk mencegah kotoran-kotoran yang berasal dari lingkungan luar.';

                // Pesan tambahan jika belum mengganti oli mesin
                // $keterangan .= ' Juga, disarankan untuk mengganti oli mesin karena usia oli mesin telah mencapai batasnya. Harga estimasi untuk penggantian oli adalah Rp 50.000-100.000.';
            } elseif ($perbedaan_km >= 10000 && $perbedaan_km < 15000) {
                $rekomendasi = 'Ganti Kampas Rem';
                $harga = '60.000-120.000';
                $keterangan = 'Pastikan kondisi kampas rem dalam kondisi layak pakai. Itu artinya kampas rem masih memiliki ketebalan yang ideal untuk bergesekan dengan cakram atau tromol. Jangan tunda penggantian seandainya diperlukan.';
            } else {
                $rekomendasi = 'Lakukan Servis ke tempat Servis Resmi';
                $harga = '60.000-160.000';
                $keterangan = 'Jika kamu tidak melakukan servis motor berkala, maka kemungkinan akan banyak yang diperiksa, pastikan budget yang kamu bawa berlebih.';
            }
        }

        $data = [
            'km_sebelum' => $km_sebelum,
            'km_sekarang' => $km_sekarang,
            'jenis_motor' => $jenis_motor,
            'harga' => $harga,
            'bengkel' => $request->input('bengkel'),
            'treatment' => $rekomendasi,
            'user_id' => Auth::id(),
        ];

        Cek::create($data);

        return response()->json([
            'data' => $data,
            'rekomendasi' => $rekomendasi,
            'keterangan' => $keterangan,
            'perbedaan_km' => $perbedaan_km,
        ]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cek = Cek::findOrFail($id);

        return response()->json($cek);
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
        $update_data = Cek::where('id', $id)->update($request->all());

        if ($update_data) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Riwayat cek berhasil di perbarui',
            ];
        } else {
            $hasil = [
                'pesan' => 'Riwayat cek Gagal di perbarui', 400
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
        $hapus_cek = Cek::destroy($id);

        if ($hapus_cek) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Riwayat cek berhasil dihapus',
            ];
        } else {
            $hasil = [
                'status' => '400',
                'pesan' => 'Riwayat cek gagal dihapus',
            ];
        }

        return response()->json($hasil);
    }
}
