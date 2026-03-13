<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@123.com'],
            [
                'name' => 'BARE Admin',
                'password' => Hash::make('123123123'),
                'phone' => '0900000000',
                'membership_level' => 'member',
                'points' => 0,
                'is_admin' => true,
            ]
        );
    }
}

