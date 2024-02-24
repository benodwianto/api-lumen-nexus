<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        User::create([
            'username' => 'Bambang',
            'email' => 'bam@gmail.com',
            'password' => 'pass',
            'api-token' => '12345',
            'status' => '1',
        ]);

        // User::create([
        //     'username' => 'Nanang',
        //     'email' => 'bam@gmail.com',
        //     'password' => 'pass',
        //     'api-token' => '12345',
        //     'status' => 'user',
        // ]);

        Product::create([
            'nama_produk' => 'Cara ubah dosa jadi saldo dana',
            'kategori_id' => 1,
            'harga' => 20000,
            'tautan' => 'Bambang nurjana',
            'deskripsi' => 'Barang yang sangat bagus untuk anda jadikan deban belinya dimanapun kapanpun dan dimanapu dan besok pagi lagi',
            'img' => 'marapi.jpg'
        ]);
        Product::create([
            'nama_produk' => 'saldo dana',
            'kategori_id' => 2,
            'harga' => 20000,
            'tautan' => 'Bambang nurjana',
            'deskripsi' => 'Barang yang sangat bagus untuk anda jadikan deban belinya dimanapun kapanpun dan dimanapu dan besok pagi lagi',
            'img' => 'marapi.jpg'
        ]);

        Product::create([
            'nama_produk' => 'Cara ubah dosa ',
            'kategori_id' => 1,
            'harga' => 20000,
            'tautan' => 'Bambang nurjana',
            'deskripsi' => 'Barang yang sangat bagus untuk anda jadikan deban belinya dimanapun kapanpun dan dimanapu dan besok pagi lagi',
            'img' => 'marapi.jpg'
        ]);

        Product::create([
            'nama_produk' => ' jadi saldo dana',
            'kategori_id' => 1,
            'harga' => 20000,
            'tautan' => 'Bambang nurjana',
            'deskripsi' => 'Barang yang sangat bagus untuk anda jadikan deban belinya dimanapun kapanpun dan dimanapu dan besok pagi lagi',
            'img' => 'marapi.jpg'
        ]);
    }
}
