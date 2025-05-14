<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin12345'), // Ganti 'password' dengan password yang lebih kuat
            'role' => 'admin',
        ]);

        // Akun Pengguna Biasa (Opsional)
        User::create([
            'name' => 'Rizky Immanuel Siburian',
            'email' => 'rizky@gmail.com',
            'password' => Hash::make('rizky12345'), // Ganti 'password' dengan password yang lebih kuat
            'role' => 'user',
        ]);
    }
}