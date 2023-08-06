<?php

namespace Database\Seeders;

use App\Models\SiteMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteMenuSeeder extends Seeder
{
    private $menu = [
        [
            'name' => 'Home',
            'site_page_id' => 4
        ],
        [
            'name' => 'Tracks',
            'site_page_id' => 8
        ],
        [
            'name' => 'Playlists',
            'site_page_id' => 5
        ],
        [
            'name' => 'Music kits',
            'site_page_id' => 10
        ],
        [
            'name' => 'Pricing',
            'site_page_id' => 7
        ],
        [
            'name' => 'About',
            'site_page_id' => 1
        ],
        [
            'name' => 'Contacts',
            'site_page_id' => 2
        ],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= count($this->menu); $i++) {
            SiteMenu::create([
                ...$this->menu[$i - 1],
                'order' => $i
            ]);
        }
    }
}
