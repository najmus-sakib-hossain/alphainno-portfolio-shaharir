<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update admin user
        User::updateOrCreate(
            ['email' => 'shahriar@gmail.com'],
            [
                'name' => 'Shahriar Khan',
                'password' => Hash::make('shahriar@password'),
                'email_verified_at' => now(),
            ]
        );
    }
}
