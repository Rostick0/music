<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subscriptions = [
            [
                'subscription_types_id' => 1,
                'users_id' => 1,
                'is_auto_renewal' => 0,
                'date_end' => Carbon::now()->addMonth(),
            ],
            [
                'subscription_types_id' => 2,
                'users_id' => 2,
                'is_auto_renewal' => 1,
                'date_end' => Carbon::now()->addYear(),
            ],
            [
                'subscription_types_id' => 2,
                'users_id' => 3,
                'is_auto_renewal' => 1,
                'date_end' => Carbon::now()->addMonth(),
            ],
            [
                'subscription_types_id' => 2,
                'users_id' => 4,
                'is_auto_renewal' => 1,
                'date_end' => Carbon::now()->addYear(),
            ],
        ];

        foreach ($subscriptions as $subscription) {
            Subscription::firstOrCreate($subscription);
        }
    }
}
