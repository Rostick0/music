<?php

namespace Database\Seeders;

use App\Models\MusicKit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusicKitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $music_kits = [
            [
                'name' => 'Коротко',
                'link' => '1690965462.mp3',
                'duration' => '5:11',
                'music_id' => 1,
            ],
            [
                'name' => 'Коротко 2',
                'link' => '1690965463.mp3',
                'duration' => '2:06',
                'music_id' => 2,
            ],
            [
                'name' => 'Коротко 3',
                'link' => '1690965464.mp3',
                'duration' => '5:11',
                'music_id' => 2,
            ],
            [
                'name' => 'Коротко 4',
                'link' => '1690965465.mp3',
                'duration' => '2:06',
                'music_id' => 1,
            ]
        ];

        foreach ($music_kits as $music_kit) {
            MusicKit::firstOrCreate($music_kit);
        }
    }
}
