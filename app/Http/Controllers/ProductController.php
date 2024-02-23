<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =  Product::all();
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
            'stok' => 'required|numeric',
            'img' => 'required',
            'kategori_id' => 'required',
            'deskripsi' => 'required|min:30',
        ]);

        $img = $request->file('img')->getClientOriginalName('img');
        $request->file('img')->move('img', $img);

        $data = [
            'nama_produk' => $request->input('nama_produk'),
            'kategori_id' => $request->input('kategori_id'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'img' => url('img', $img),
            'deskripsi' => $request->input('deskripsi'),
        ];

        Product::create($data);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
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
        Product::where('id', $id)->update($request->all());

        return response()->json('Data Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product, $id)
    {
        Product::where('id', $id)->delete();

        return response()->json('Data Berhasil dihapus');
    }
}
