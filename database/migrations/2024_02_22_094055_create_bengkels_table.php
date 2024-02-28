<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bengkels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_bengkel');
            $table->foreignId('id_user');
            $table->string('foto-bengkel')->nullable();
            $table->integer('jam_buka')->nullable();
            $table->integer('jam_tutup')->nullable();
            $table->integer('nohp');
            $table->string('alamat');
            $table->text('deskripsi')->nullable();
            $table->string('foto-galeri-1')->nullable();
            $table->string('foto-galeri-2')->nullable();
            $table->string('foto-galeri-3')->nullable();
            $table->string('foto-galeri-4')->nullable();
            $table->string('foto-galeri-5')->nullable();
            $table->string('foto-galeri-6')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bengkels');
    }
};
