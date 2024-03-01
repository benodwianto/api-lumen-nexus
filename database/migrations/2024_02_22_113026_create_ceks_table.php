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
        Schema::create('ceks', function (Blueprint $table) {
            $table->id();
            $table->integer('km_sebelum');
            $table->integer('km_sekarang');
            $table->foreignId('bengkel')->nullable();
            $table->foreignId('user_id');
            $table->string('harga');
            $table->string('treatment');
            $table->enum('jenis_motor', ['Manual', 'Matic', 'Kopling']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ceks');
    }
};
