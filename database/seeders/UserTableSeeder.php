<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Smart Planner',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'), // Mengenkripsi password jadi aman
        ]);
    }
}

