<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();

        // Assuming that there are already authors, categories, and publishers in the database
        $authorIds = DB::table('authors')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();
        $publisherIds = DB::table('publishers')->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            DB::table('books')->insert([
                'title' => $faker->sentence,
                'author_id' => $faker->randomElement($authorIds),
                'category_id' => $faker->randomElement($categoryIds),
                'publisher_id' => $faker->randomElement($publisherIds),
                'isbn' => $faker->unique()->isbn13,
                'publication_date' => $faker->date(),
                'number_of_pages' => $faker->numberBetween(50, 1000),
                'summary' => $faker->paragraph,
                'cover_image' => 'frontend/images/book.jpg',
                'type' => $faker->randomElement(['popular', 'recent', 'featured', 'recommended']),
                'preview' => $faker->randomElement(['active', 'inactive']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
