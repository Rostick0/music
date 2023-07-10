<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    private $statistics = [
        [
            'type' => 'subscription',
            'type_paid' => 'month',
            'users_id' => 1,
        ],
        [
            'type' => 'register',
            'users_id' => 4,
        ],
        [
            'type' => 'download',
            'type_paid' => 'month',
            'users_id' => 1,
            'music_id' => 1
        ],
        [
            'type' => 'subscription',
            'type_paid' => 'year',
            'users_id' => 3,
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->statistics as $statistic) {
            Statistic::firstOrCreate($statistic);
        }
    }
}
