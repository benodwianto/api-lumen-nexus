<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\Coment;
use App\Models\Bengkel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
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
    public function store(Request $request, $bengkel_id)
    {
        // Validasi input
        $this->validate($request, [
            'komentar' => 'required|string|max:255',
            'rating' => 'required|numeric|min:1|max:5', // Batas maksimum adalah 5
        ]);

        // Buat rating baru
        $rating = new Rate();
        $rating->user_id = auth()->user()->id;
        $rating->bengkel_id = $bengkel_id;
        $rating->rating = min(5, $request->input('rating')); // Menetapkan rating ke nilai maksimum 5 jika melebihi batas
        $rating->save();

        // Buat komentar baru
        $komentar = new Coment();
        $komentar->komentar = $request->input('komentar');
        $komentar->user_id = auth()->user()->id; // Menggunakan helper auth() untuk mendapatkan user yang sedang login
        $komentar->bengkel_id = $bengkel_id;
        $komentar->save();

        // Perbarui rating rata-rata bengkel
        $bengkel = Bengkel::find($bengkel_id);
        if ($bengkel) {
            // Update jumlah review
            $bengkel->review_count += 1;

            // Update total rating
            $total_rating = Rate::where('bengkel_id', $bengkel_id)->sum('rating');
            $average_rating = $total_rating / $bengkel->review_count;
            $bengkel->rating = $average_rating;

            $bengkel->save();
        }

        // Response berhasil
        return response()->json([
            'message' => 'Komentar dan rating berhasil ditambahkan',
            'data' => $rating,
            'komentar' => $komentar,
        ], 201);
    }





    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        //
    }
}
