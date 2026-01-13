<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'phone_number' => '0890987654321',
                'password' => bcrypt('admin@gmail.com'),
                'role' => 'admin',
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@gmail.com',
                'phone_number' => '081234567890',
                'password' => bcrypt('user@gmail.com'),
                'role' => 'user',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
