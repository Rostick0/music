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
                'link' => 'https://music.arizona-rp.com/rodina/1686521221.mp3',
                'duration' => '0:11',
                'music_id' => 1,
            ],
            [
                'name' => 'Коротко 2',
                'link' => 'https://music.arizona-rp.com/rodina/1686521221.mp3',
                'duration' => '0:14',
                'music_id' => 2,
            ],
            [
                'name' => 'Коротко 3',
                'link' => 'https://music.arizona-rp.com/rodina/1686521221.mp3',
                'duration' => '0:16',
                'music_id' => 2,
            ],
            [
                'name' => 'Коротко 4',
                'link' => 'https://music.arizona-rp.com/rodina/1686521221.mp3',
                'duration' => '0:06',
                'music_id' => 1,
            ]
        ];

        foreach ($music_kits as $music_kit) {
            MusicKit::firstOrCreate($music_kit);
        }
    }
}
