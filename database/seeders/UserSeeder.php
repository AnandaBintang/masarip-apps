<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Administrator
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'nama' => 'Administrator',
                'role' => 'administrator',
                'username' => 'admin',
                'password' => Hash::make('password'), // Change to a secure password
            ]
        );

        // Petugas
        User::updateOrCreate(
            ['username' => 'petugas'],
            [
                'nama' => 'Petugas',
                'role' => 'petugas',
                'username' => 'petugas',
                'password' => Hash::make('password'), // Change to a secure password
            ]
        );

        // Staff
        User::updateOrCreate(
            ['username' => 'staff'],
            [
                'nama' => 'Staff',
                'role' => 'staff',
                'username' => 'staff',
                'password' => Hash::make('password'), // Change to a secure password
            ]
        );
    }
}
