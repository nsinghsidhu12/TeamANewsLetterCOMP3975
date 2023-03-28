<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = 'aa@aa.aa';
        $user = User::where('email', '=', $email)->first();
        if ($user === null) {
            $user = User::create([
                'name' => 'aa',
                'email' => $email,
                'password' => Hash::make('P@$$w0rd'),
            ]);
        }
    }
}
