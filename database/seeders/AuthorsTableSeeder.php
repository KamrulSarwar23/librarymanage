<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            DB::table('authors')->insert([
                'name' => $faker->name,
                'image' => $faker->optional()->imageUrl(640, 480, 'people'),
                'address' => $faker->address,
                'date_of_birth' => $faker->date(),
                'date_of_death' => $faker->date(),
                'biography' => $faker->paragraph,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
