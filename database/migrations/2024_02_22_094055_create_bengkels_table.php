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
            $table->foreignId('user_id');
            $table->string('foto_bengkel')->nullable();
            $table->integer('jam_buka')->nullable();
            $table->integer('jam_tutup')->nullable();
            $table->string('nohp');
            $table->string('alamat');
            $table->string('link_gmaps');
            $table->text('deskripsi')->nullable();
            $table->float('rating')->default(0);
            $table->integer('review_count')->default(0);
            $table->string('foto_galeri_1')->nullable();
            $table->string('foto_galeri_2')->nullable();
            $table->string('foto_galeri_3')->nullable();
            $table->string('foto_galeri_4')->nullable();
            $table->string('foto_galeri_5')->nullable();
            $table->string('foto_galeri_6')->nullable();
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
