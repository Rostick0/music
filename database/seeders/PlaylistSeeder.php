<?php

namespace Database\Seeders;

use App\Models\Playlist;
use App\Models\RelationshipGenre;
use App\Models\RelationshipMood;
use App\Models\RelationshipPlaylist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlaylistSeeder extends Seeder
{
    private $list = [
        [
            'playlist' => [
                'title' => 'Тестовое',
                'description' => 'Описание',
            ],
            'relationship_playlist' => [
                'music_id' => 1
            ],
            'genre' => 1
        ],
        [
            'playlist' => [
                'title' => 'Нов нов',
            ],
            'relationship_playlist' => [
                'music_id' => 1
            ],
            'mood' => 2
        ],
    ];
    public function run(): void
    {
        foreach ($this->list as $item) {
            $playlist = Playlist::create($item['playlist']);
            RelationshipPlaylist::create([
                'playlist_id' => $playlist->id,
                ...$item['relationship_playlist']
            ]);

            if (isset($item['genre'])) {
                RelationshipGenre::create([
                    'type_id' => $playlist->id,
                    'type' => 'playlist',
                    'genre_id' => $item['genre']
                ]);
            }

            if (isset($item['mood'])) {
                RelationshipMood::create([
                    'type_id' => $playlist->id,
                    'type' => 'playlist',
                    'mood_id' => $item['mood']
                ]);
            }
        }
    }
}
