<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'password' => Hash::make('password'),
            'api-token' => '12345',
            'status' => '1',
        ]);

        Category::create([
            'nama_kategori' => 'Oli Mesin',
        ]);
        Category::create([
            'nama_kategori' => 'Oli Gardan',
        ]);
        Category::create([
            'nama_kategori' => 'Busi',
        ]);
        Category::create([
            'nama_kategori' => 'Kampas Rem',
        ]);
        Category::create([
            'nama_kategori' => 'Filter Udara',
        ]);
        Category::create([
            'nama_kategori' => 'lainnya',
        ]);

        Product::create([
            'nama_produk' => 'Cara ubah dosa jadi saldo dana',
            'kategori_id' => 1,
            'user_id' => 1,
            'harga' => 20000,
            'tautan' => 'Bambang nurjana',
            'deskripsi' => 'Barang yang sangat bagus untuk anda jadikan deban belinya dimanapun kapanpun dan dimanapu dan besok pagi lagi',
            'img' => 'marapi.jpg'
        ]);
        Product::create([
            'nama_produk' => 'saldo dana',
            'kategori_id' => 2,
            'user_id' => 1,
            'harga' => 20000,
            'tautan' => 'Bambang nurjana',
            'deskripsi' => 'Barang yang sangat bagus untuk anda jadikan deban belinya dimanapun kapanpun dan dimanapu dan besok pagi lagi',
            'img' => 'marapi.jpg'
        ]);

        Product::create([
            'nama_produk' => 'Cara ubah dosa ',
            'kategori_id' => 1,
            'user_id' => 1,
            'harga' => 20000,
            'tautan' => 'Bambang nurjana',
            'deskripsi' => 'Barang yang sangat bagus untuk anda jadikan deban belinya dimanapun kapanpun dan dimanapu dan besok pagi lagi',
            'img' => 'marapi.jpg'
        ]);

        Product::create([
            'nama_produk' => ' jadi saldo dana',
            'kategori_id' => 1,
            'user_id' => 1,
            'harga' => 20000,
            'tautan' => 'Bambang nurjana',
            'deskripsi' => 'Barang yang sangat bagus untuk anda jadikan deban belinya dimanapun kapanpun dan dimanapu dan besok pagi lagi',
            'img' => 'marapi.jpg'
        ]);
    }
}
