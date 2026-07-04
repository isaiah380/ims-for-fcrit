<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the default admin user.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@fcrit.ac.in'],
            [
                'name'      => 'Admin',
                'password'  => Hash::make('admin@123'),
                'role'      => 'admin',
                'is_active' => true,
            ]
        );
    }
}
