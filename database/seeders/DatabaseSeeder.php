<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::insert([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'team' => 'IT',
            'department' => 'IT',
            'nik' => '0001',
        ]);
    }
}
