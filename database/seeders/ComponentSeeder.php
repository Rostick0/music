<?php

namespace Database\Seeders;

use App\Models\Component;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $components = [
            [
                'name' => 'banner',
                'path' => 'banner'
            ],
            [
                'name' => 'faq',
                'path' => 'faq'
            ],
            [
                'name' => 'main-banner',
                'path' => 'main-banner'
            ],
            [
                'name' => 'player',
                'path' => 'player'
            ],
            [
                'name' => 'playlists_list',
                'path' => 'playlists_list'
            ],
            [
                'name' => 'tracks_list',
                'path' => 'tracks_list'
            ],
        ];

        foreach ($components as $component) {
            Component::create($component);
        }
    }
}
