<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            GenreSeeder::class,
            MusicSeeder::class,
            SitePageSeeder::class,
            RemoveClaimSeeder::class,
            SubscriptionTypeSeeder::class,
            SubscriptionSeeder::class,
            StatisticSeeder::class,
            NoticeSeeder::class
        ]);
    }
}
