<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $data = product::where('user_id', $user->id)->get();
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
        $this->validate($request, [
            'nama_produk' => 'required|unique:products',
            'harga' => 'required|numeric',
            'tautan' => 'required',
            'img' => 'required|mimes:jpeg,png,jpg|max:1000',
            'kategori_id' => 'required|numeric',
            'deskripsi' => 'required|min:30',
        ]);


        $img = $request->file('img')->getClientOriginalName('img');
        $request->file('img')->move('img', $img);

        $data = [
            'nama_produk' => $request->input('nama_produk'),
            'kategori_id' => $request->input('kategori_id'),
            'harga' => $request->input('harga'),
            'tautan' => $request->input('tautan'),
            'img' => url('img', $img),
            'deskripsi' => $request->input('deskripsi'),
            'user_id' => Auth::id()
        ];

        $tambah_data = Product::create($data);

        if ($tambah_data) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Data berhasi di ditambahkan',
                'data' => $data
            ];
        } else {
            $hasil = [
                'status' => '400',
                'pesan' => 'Data Gagal di ditambahkan',
                'data' => $data
            ];
        }

        return response()->json($hasil);
    }

    public function rateProduct(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $product = Product::findOrFail($id);
        $product->rating = ($product->rating * $product->review_count + $request->rating) / ($product->review_count + 1);
        $product->review_count++;
        $product->save();

        return response()->json(['message' => 'Rating berhasil ditambahkan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product, $id)
    {
        $product = product::findorFail($id);

        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product, $id)
    {
        $update_data = Product::where('id', $id)->update($request->all());

        if ($update_data) {
            $hasil = [
                'status' => '200',
                'pesan' => 'Data berhasi di perbarui',
            ];
        } else {
            $hasil = [
                'status' => '400',
                'pesan' => 'Data Gagal di perbarui',
            ];
        }

        return response()->json($hasil);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product, $id)
    {
        $produk = product::findOrFail($id);

        // Hapus file gambar jika ada
        $filename = 'img/' . $produk->img;
        if (file_exists($filename)) {
            unlink($filename); // Hapus file dari penyimpanan
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
