<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'status' => 'active',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'role' => 'user',
            'status' => 'active',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'role' => 'user',
            'status' => 'active',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'user3',
            'email' => 'user3@gmail.com',
            'role' => 'user',
            'status' => 'active',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'user4',
            'email' => 'user4@gmail.com',
            'role' => 'user',
            'status' => 'active',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'user5',
            'email' => 'user5@gmail.com',
            'role' => 'user',
            'status' => 'active',
            'password' => Hash::make('password')
        ]);

    }
}
