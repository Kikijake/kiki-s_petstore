<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'MainAdmin',
            'email' => 'kikipetstore@gmail.com',
            'role' => 'admin',
            'phone' => '0979797979',
            'address' => 'yangon',
            'password' => Hash::make('admin123')
        ]);
    }
}
