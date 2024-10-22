<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Jomel Isidro',
            'email' => 'jomelphdev@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
