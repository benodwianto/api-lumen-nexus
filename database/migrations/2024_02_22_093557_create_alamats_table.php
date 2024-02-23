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
        Schema::create('alamats', function (Blueprint $table) {
            $table->bigIncrements('id_user_alamat');
            $table->foreignId('id_user');
            $table->string('no_telp');
            $table->string('nama_penerima');
            $table->integer('id_provinsi');
            $table->string('nama_prov');
            $table->integer('id_kota');
            $table->string('nama_kota');
            $table->string('kode_pos')->nullable();
            $table->text('alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamats');
    }
};
