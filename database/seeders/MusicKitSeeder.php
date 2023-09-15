<?php

namespace Database\Seeders;

use App\Models\MusicArtist;
use App\Models\MusicKit;
use App\Http\Controllers\RelationshipGenreController;
use App\Http\Controllers\RelationshipInstrumentController;
use App\Http\Controllers\RelationshipMoodController;
use App\Http\Controllers\RelationshipThemeController;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MusicKitSeeder extends Seeder
{
    private $music_kit = [
        [
            'title' => 'Заголовок',
            'link' => '1690965462.mp3',
            'link_demo' => 'demo.mp3',
            'publisher' => 'https://vk.com',
            'distr' => 'https://vk.com',
            'duration' => '00:05:11',
            'duration_demo' => '00:02:11',
            'is_active' => 1
        ],
        [
            'title' => 'Новая песня',
            'link' => '1690965465.mp3',
            'link_demo' => 'demo.mp3.mp3',
            'publisher' => 'https://vk.com',
            'distr' => 'https://vk.com',
            'duration' => '00:05:11',
            'duration_demo' => '00:02:11',
            'is_active' => 1
        ],
    ];

    private $moods = [
        'Радость',
        'Грусть'
    ];

    private $instruments = [
        'Гитара',
        'Барабан'
    ];

    private $themes = [
        1,
        2,
    ];

    private $music_artists = [
        'новый певец',
        'лучший'
    ];

    private $genres = [
        1,
        2
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < count($this->music_kit); $i++) {
            $music_artists = MusicArtist::firstOrCreate([
                'name' => $this->music_artists[$i]
            ]);

            $music_kit = MusicKit::firstOrCreate([
                ...$this->music_kit[$i],
                'music_artist_id' => $music_artists->id
            ]);

            RelationshipGenreController::createAndDeleteRelationship($this->genres[$i], $music_kit->id, 'music_kit');
            RelationshipInstrumentController::createAndDeleteRelationship($this->instruments[$i], $music_kit->id, 'music_kit');
            RelationshipMoodController::createAndDeleteRelationship($this->moods[$i], $music_kit->id, 'music_kit');
            RelationshipThemeController::createAndDeleteRelationship($this->themes[$i], $music_kit->id, 'music_kit');
        }
    }
}
