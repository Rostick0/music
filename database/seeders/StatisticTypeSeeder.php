<?php

namespace Database\Seeders;

use App\Models\StatisticType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatisticTypeSeeder extends Seeder
{
    private $statistic_types = [
        'subscription',
        'register',
        'download'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->statistic_types as $statistic_type) {
            StatisticType::firstOrCreate([
                'name' => $statistic_type
            ]);
        }
    }
}
