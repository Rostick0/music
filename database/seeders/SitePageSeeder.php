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
            'path' => 'about.blade.php'
        ],
        [
            'name' => 'contacts',
            'url' => 'contacts',
            'seo_title' => 'contacts',
            'seo_description' => 'contacts',
            'path' => 'contacts.blade.php'
        ],
        [
            'name' => 'favorite',
            'url' => 'favorite',
            'seo_title' => 'favorite',
            'seo_description' => 'favorite',
            'path' => 'favorite.blade.php'
        ],
        [
            'name' => 'home',
            'url' => 'home',
            'seo_title' => 'home',
            'seo_description' => 'home',
            'path' => 'home.blade.php'
        ],
        [
            'name' => 'playlists',
            'url' => 'playlists',
            'seo_title' => 'playlists',
            'seo_description' => 'playlists',
            'path' => 'playlists.blade.php'
        ],
        [
            'name' => 'pricing',
            'url' => 'pricing',
            'seo_title' => 'pricing',
            'seo_description' => 'pricing',
            'path' => 'pricing.blade.php'
        ],
        [
            'name' => 'sign_in',
            'url' => 'sign_in',
            'seo_title' => 'sign_in',
            'seo_description' => 'sign_in',
            'path' => 'sign_in.blade.php'
        ],
        [
            'name' => 'sign_up',
            'url' => 'sign_up',
            'seo_title' => 'sign_up',
            'seo_description' => 'sign_up',
            'path' => 'sign_up.blade.php'
        ],
        [
            'name' => 'tracks',
            'url' => 'tracks',
            'seo_title' => 'tracks',
            'seo_description' => 'tracks',
            'path' => 'tracks.blade.php'
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SitePage::insert($this->pages);
    }
}
