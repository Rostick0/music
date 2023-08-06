<?php

namespace Database\Seeders;

use App\Models\SitePage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SitePageSeeder extends Seeder
{
    private $pages = [
        [
            'name' => 'about',
            'url' => 'about',
            'seo_title' => 'about',
            'seo_description' => 'about',
            'path' => 'about'
        ],
        [
            'name' => 'contacts',
            'url' => 'contacts',
            'seo_title' => 'contacts',
            'seo_description' => 'contacts',
            'path' => 'contacts'
        ],
        [
            'name' => 'favorite',
            'url' => 'favorite',
            'seo_title' => 'favorite',
            'seo_description' => 'favorite',
            'path' => 'favorite'
        ],
        [
            'name' => 'home',
            'url' => 'home',
            'seo_title' => 'home',
            'seo_description' => 'home',
            'path' => 'home'
        ],
        [
            'name' => 'playlists',
            'url' => 'playlists',
            'seo_title' => 'playlists',
            'seo_description' => 'playlists',
            'path' => 'playlists'
        ],
        [
            'name' => 'playlist',
            'url' => 'playlist',
            'seo_title' => 'playlist',
            'seo_description' => 'playlist',
            'path' => 'playlist'
        ],
        [
            'name' => 'pricing',
            'url' => 'pricing',
            'seo_title' => 'pricing',
            'seo_description' => 'pricing',
            'path' => 'pricing'
        ],
        [
            'name' => 'tracks',
            'url' => 'tracks',
            'seo_title' => 'tracks',
            'seo_description' => 'tracks',
            'path' => 'tracks'
        ],
        [
            'name' => 'track',
            'url' => 'track',
            'seo_title' => 'track',
            'seo_description' => 'track',
            'path' => 'track'
        ],
        [
            'name' => 'music_kits',
            'url' => 'music_kits',
            'seo_title' => 'music_kits',
            'seo_description' => 'music_kits',
            'path' => 'music_kits'
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->pages as $page) {
            SitePage::firstOrCreate($page);
        }
    }
}
