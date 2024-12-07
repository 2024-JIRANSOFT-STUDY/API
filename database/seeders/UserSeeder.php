<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private function generateUsers(): array
    {
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $email = "admin{$i}@jiran.com";
            $users[] = [
                'name' => '관리자',
                'email' => $email,
                'password' => Hash::make($email),
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ];
        }
        return $users;
    }

    public function run(): void
    {
        User::insert($this->generateUsers());
    }
}