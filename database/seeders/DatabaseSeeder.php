<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create or update the primary Admin user
        User::updateOrCreate(
            ['email' => 'asepsurya1998@gmail.com'],
            [
                'name' => 'Asep Surya',
                'password' => bcrypt('asepsurya1998'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );
    }
}
