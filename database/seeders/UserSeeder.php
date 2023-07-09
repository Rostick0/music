<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    private $user = [
        [
            'name' => 'Igor',
            'surname' => 'Adrow',
            'nickname' => 'Igor',
            'email' => 'igor@mail.com',
            'password' => Hash::make('igor@mail.com')
        ],
        [
            'name' => 'Andrew',
            'surname' => 'Novov',
            'nickname' => 'andrew',
            'email' => 'andrew@mail.com',
            'password' => Hash::make('andrew@mail.com')
        ],
        [
            'name' => 'Alex',
            'surname' => 'Chickov',
            'nickname' => 'Igor',
            'email' => 'alex@mail.com',
            'password' => Hash::make('alex@mail.com')
        ],
        [
            'name' => 'Igor',
            'surname' => 'Adrow',
            'nickname' => 'Igor',
            'email' => 'igor@mail.com',
            'password' => Hash::make('igor@mail.com')
        ],
        [
            'name' => 'Yan',
            'surname' => 'Yarov',
            'nickname' => 'Igor',
            'email' => 'yan@mail.com',
            'password' => Hash::make('yan@mail.com')
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert($this->user);
    }
}
