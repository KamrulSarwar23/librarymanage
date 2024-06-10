<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookQuantitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = DB::table('books')->get();



        foreach ($books as $book) {
            $quantity = rand(0, 100);
            DB::table('book_quantities')->insert([
                'book_id' => $book->id,
                'quantity' => $quantity,
                'current_qty' => $quantity,
                'status' => 'activate',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
