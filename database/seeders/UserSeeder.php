<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Igor',
                'surname' => 'Adrow',
                'nickname' => 'Igor',
                'email' => 'igor@mail.com',
                'password' => Hash::make('igor@mail.com'),
            ],
            [
                'name' => 'Andrew',
                'surname' => 'Novov',
                'nickname' => 'Andrew',
                'email' => 'andrew@mail.com',
                'password' => Hash::make('andrew@mail.com'),
            ],
            [
                'name' => 'Alex',
                'surname' => 'Chickov',
                'nickname' => 'Alex',
                'email' => 'alex@mail.com',
                'password' => Hash::make('alex@mail.com'),
            ],
            [
                'name' => 'Oleg',
                'surname' => 'Adrow',
                'nickname' => 'Oleg',
                'email' => 'oleg@mail.com',
                'password' => Hash::make('oleg@mail.com'),
            ],
            [
                'name' => 'Yan',
                'surname' => 'Yarov',
                'nickname' => 'Yan',
                'email' => 'yan@mail.com',
                'password' => Hash::make('yan@mail.com'),
            ],
            [
                'name' => 'Artem',
                'surname' => 'Artem',
                'nickname' => 'Artem',
                'email' => 'avs29rus@mail.ru',
                'password' => Hash::make('@test1234'),
                'is_agree' => 1,
                'is_admin' => 1
            ]
        ];

        foreach ($users as $user) {
            User::firstOrCreate($user);
        }
    }
}
