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
            $table->foreignId('id_user');
            $table->string('foto-bengkel');
            $table->integer('jam_buka');
            $table->integer('jam_tutup');
            $table->string('foto-galeri-1');
            $table->string('foto-galeri-2');
            $table->string('foto-galeri-3');
            $table->string('foto-galeri-4');
            $table->string('foto-galeri-5');
            $table->string('foto-galeri-6');
            $table->text('deskripsi');
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
