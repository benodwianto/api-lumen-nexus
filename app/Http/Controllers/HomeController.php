<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Coment;
use App\Models\Bengkel;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_produk = Product::all();
        $data_bengkel = Bengkel::all();
        $data_komentar = Coment::all();
        $data_kategori = Category::all();
        return response()->json([
            'data_produk' => $data_produk,
            'data_bengkel' => $data_bengkel,
            'data_komentar' => $data_komentar,
            'data_kategori' => $data_kategori
        ]);
    }

    public function search(Request $request)
    {
        // Mendapatkan parameter pencarian
        $search = $request->input('search');
        $sortBy = $request->input('sort_by', 'created_at');
        $sortDirection = $request->input('sort_direction', 'desc');

        // Query untuk pencarian produk
        $productsQuery = Product::query();
        if ($search) {
            $productsQuery->where(function ($query) use ($search) {
                $query->where('nama_produk', 'like', "%$search%")
                    ->orWhere('deskripsi', 'like', "%$search%");
            });
        }
        $productsQuery->orderBy($sortBy, $sortDirection);
        if ($sortBy == 'harga') {
            $productsQuery->orderBy('harga', $sortDirection);
        }

        // Query untuk pencarian bengkel
        $bengkelsQuery = Bengkel::query();
        if ($search) {
            $bengkelsQuery->where('nama_bengkel', 'like', "%$search%");
        }
        $bengkelsQuery->orderBy($sortBy, $sortDirection);

        // Mengambil hasil pencarian dengan paginasi
        $products = $productsQuery->paginate(10);
        $bengkels = $bengkelsQuery->paginate(10);

        // Memeriksa apakah hasil pencarian kosong
        $productCount = $products->count();
        $bengkelCount = $bengkels->count();

        // Membuat pesan jika hasil pencarian kosong
        $message = '';
        if ($productCount === 0 && $bengkelCount === 0) {
            $message = 'Kami tidak dapat menemukan data yang sesuai dengan pencarian Anda.';
        }

        // Mengembalikan hasil pencarian beserta pesan
        return response()->json([
            'products' => $products,
            'bengkels' => $bengkels,
            'message' => $message
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sortByHighestRating()
    {
        $bengkels = Bengkel::orderByDesc('rating')->get();
        return response()->json($bengkels);
    }

    public function sortByLowestRating()
    {
        $bengkels = Bengkel::orderBy('rating')->get();
        return response()->json($bengkels);
    }

    public function sortByLatest()
    {
        $bengkels = Bengkel::orderByDesc('created_at')->get();
        return response()->json($bengkels);
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
        //
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
