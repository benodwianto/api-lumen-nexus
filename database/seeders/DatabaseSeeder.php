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
            'status' => 'admin',
        ]);

        User::create([
            'username' => 'Nanang',
            'email' => 'bam@gmail.com',
            'password' => 'pass',
            'api-token' => '12345',
            'status' => 'user',
        ]);

        Product::create([
            'title' => 'Cara ubah dosa jadi saldo dana',
            'category_id' => 1,
            'price' => 20000,
            'stock' => 100,
            'publisher' => 'Bambang nurjana',
            'img' => 'marapi.jpg'
        ]);
        Product::create([
            'title' => 'saldo dana',
            'category_id' => 2,
            'price' => 20000,
            'stock' => 100,
            'publisher' => 'Bambang nurjana',
            'img' => 'marapi.jpg'
        ]);

        Product::create([
            'title' => 'Cara ubah dosa ',
            'category_id' => 1,
            'price' => 20000,
            'stock' => 100,
            'publisher' => 'Bambang nurjana',
            'img' => 'marapi.jpg'
        ]);

        Product::create([
            'title' => ' jadi saldo dana',
            'category_id' => 1,
            'price' => 20000,
            'stock' => 100,
            'publisher' => 'Bambang nurjana',
            'img' => 'marapi.jpg'
        ]);
    }
}
