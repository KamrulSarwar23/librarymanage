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

        for ($i = 0; $i < 5; $i++) {
            DB::table('publishers')->insert([
                'name' => $faker->company,
                // 'image' => $faker->imageUrl(640, 480, 'business'),
                'email' => $faker->safeEmail,
                'phone' => $faker->phoneNumber,
                'description' => $faker->sentence,
                'address' => $faker->address,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
