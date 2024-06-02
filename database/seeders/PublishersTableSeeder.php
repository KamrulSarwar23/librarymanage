<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PublishersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('publishers')->insert([
                'name' => $faker->company,
                'image' => $faker->optional()->imageUrl(640, 480, 'business'),
                'email' => $faker->optional()->safeEmail,
                'phone' => $faker->optional()->phoneNumber,
                'description' => $faker->optional()->sentence,
                'address' => $faker->optional()->address,
                'status' => $faker->randomElement(['active', 'inactive']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
