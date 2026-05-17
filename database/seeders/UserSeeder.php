<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Warga',
            'email' => 'user@example.com',
            'phone' => '081234567890',
            'role' => 'user',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Petugas Bencana',
            'email' => 'officer@example.com',
            'phone' => '089876543210',
            'role' => 'officer',
            'staff_id' => 'OFF-001',
            'agency' => 'BMKG',
            'position' => 'Data Analyst',
            'password' => Hash::make('12345678'),
        ]);
    }
}