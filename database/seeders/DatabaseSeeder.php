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
            StatisticTypeSeeder::class,
            UserSeeder::class,
            GenreSeeder::class,
            MusicSeeder::class,
            MusicKitSeeder::class,
            PlaylistSeeder::class,
            StatisticSeeder::class,
            SitePageSeeder::class,
            SiteMenuSeeder::class,
            ComponentSeeder::class,
            // RemoveClaimSeeder::class,
            SubscriptionTypeSeeder::class,
            SubscriptionSeeder::class,
            // NoticeSeeder::class,
            SlideSeeder::class
        ]);
    }
}
