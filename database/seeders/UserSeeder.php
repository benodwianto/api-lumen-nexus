<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 6; $i++) {
            $data = [
                'username' => $faker->name,
                'email' => $faker->email,
                'password' => 'pass',
            ];

            User::create($data);
        }
    }
}
