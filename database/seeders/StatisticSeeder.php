<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    private $statistics = [
        [
            'statistic_types_id' => 1,
            'type_paid' => 'month',
            'users_id' => 1,
        ],
        [
            'statistic_types_id' => 2,
            'users_id' => 4,
        ],
        [
            'statistic_types_id' => 3,
            'type_paid' => 'month',
            'users_id' => 1,
            'music_id' => 1
        ],
        [
            'statistic_types_id' => 1,
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
