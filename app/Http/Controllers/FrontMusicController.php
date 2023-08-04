<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\RelationshipGenre;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;
use Illuminate\Http\Request;

class FrontMusicController extends Controller
{
    public static function getById(int $id)
    {
        $music_model = Music::where('id', $id);

        // if (!(auth()->check() && auth()->user()->is_admin)) $music_model->where('is_active', 1);

        $music = $music_model->first();

        return $music ?? abort(404);
    }

    public static function getSimilar(int $music_id)
    {
        $genre_ids = RelationshipGenre::select('genre_id')->where([
            'type' => 'music',
            'type_id' => $music_id
        ]);

        $theme_id = RelationshipTheme::select('theme_id')
            ->where([
                'type' => 'music',
                'type_id' => $music_id
            ]);

        $instrument_ids = RelationshipInstrument::select('instrument_id')
            ->where([
                'type' => 'music',
                'type_id' => $music_id
            ]);

        $mood_ids = RelationshipMood::select('mood_id')
            ->where([
                'type' => 'music',
                'type_id' => $music_id
            ]);

        $music_genre = FrontMusicController::joinArtist()
            ->whereIn('music.id', RelationshipGenre::select('type_id')
                ->where('type', 'music')
                ->whereIn('genre_id', $genre_ids));

        $music_theme = FrontMusicController::joinArtist()
            ->whereIn('music.id', RelationshipTheme::select('type_id')
                ->where('type', 'music')
                ->whereIn('theme_id', $theme_id));

        $music_instrument = FrontMusicController::joinArtist()
            ->whereIn('music.id', RelationshipInstrument::select('type_id')
                ->where('type', 'music')
                ->whereIn('instrument_id', $instrument_ids));


        $music_mood = FrontMusicController::joinArtist()
            ->whereIn('music.id', RelationshipMood::select('type_id')
                ->where('type', 'music')
                ->whereIn('mood_id', $mood_ids));


        $music_list = FrontMusicController::joinArtist()
            ->union($music_genre)
            ->union($music_theme)
            ->union($music_instrument)
            ->union($music_mood)
            ->whereNot('music.id', $music_id)
            ->paginate(8);

        return $music_list;
    }

    public static function joinArtist()
    {
        return Music::select(
            'music.*',
            'music_artists.name as music_artist_name'
        )
            ->join('music_artists', 'music.music_artist_id', '=', 'music_artists.id');
    }
}
