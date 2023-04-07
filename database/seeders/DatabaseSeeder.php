<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'mint.dev@pm.me',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ])->save();
        User::factory(10)->create();
    }
}
