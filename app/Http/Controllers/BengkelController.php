<?php

namespace App\Http\Controllers;

use App\Models\Bengkel;
use Illuminate\Http\Request;

class BengkelController extends Controller
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'foto_bengkel' => 'required|mimes:jpeg,png,jpg|max:2048',
            'jam_buka' => 'nullable|date_format:H:i',
            'jam_tutup' => 'nullable|date_format:H:i',
            'foto_galeri-1' => 'mimes:jpeg,png,jpg|max:2048',
            'foto_galeri-2' => 'mimes:jpeg,png,jpg|max:2048',
            'foto_galeri-3' => 'mimes:jpeg,png,jpg|max:2048',
            'foto_galeri-4' => 'mimes:jpeg,png,jpg|max:2048',
            'foto_galeri-5' => 'mimes:jpeg,png,jpg|max:2048',
            'foto_galeri-6' => 'mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'min:30',
            'lokasi' => 'required'
        ]);
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
    public function update(Request $request, Bengkel $bengkel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bengkel  $bengkel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bengkel $bengkel)
    {
        //
    }
}
