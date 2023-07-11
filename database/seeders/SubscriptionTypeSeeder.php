<?php

namespace Database\Seeders;

use App\Models\SubscriptionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionTypeSeeder extends Seeder
{
    private $subscription_types = [
        [
            'name' => 'Light',
            'price' => '3'
        ],
        [
            'name' => 'Pro',
            'price' => '5'
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->subscription_types as $type) {
            SubscriptionType::firstOrCreate($type);
        }
    }
}
