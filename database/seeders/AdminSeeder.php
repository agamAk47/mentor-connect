<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

/**
 * AdminSeeder
 *
 * Demonstrates:
 * - Database seeding for admin account (Unit VI)
 */
class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@mentorconnect.com'],
            [
                'name'     => 'Platform Admin',
                'email'    => 'admin@mentorconnect.com',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
