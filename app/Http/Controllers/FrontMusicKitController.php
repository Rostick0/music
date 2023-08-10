<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\MusicKit;
use App\Models\RelationshipGenre;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;
use Illuminate\Http\Request;

class FrontMusicKitController extends Controller
{
    public static function getById(int $id)
    {
        $music_kit_model = MusicKit::where('id', $id);

        if (!(auth()->check() && auth()->user()->is_admin)) $music_kit_model->where('is_active', 1);

        $music_kit = $music_kit_model->first();

        return $music_kit ?? abort(404);
    }

    public static function getSimilar(int $music_id)
    {
        $genre_ids = RelationshipGenre::select('genre_id')->where([
            'type' => 'music_kit',
            'type_id' => $music_id
        ]);

        $theme_id = RelationshipTheme::select('theme_id')
            ->where([
                'type' => 'music_kit',
                'type_id' => $music_id
            ]);

        $instrument_ids = RelationshipInstrument::select('instrument_id')
            ->where([
                'type' => 'music_kit',
                'type_id' => $music_id
            ]);

        $mood_ids = RelationshipMood::select('mood_id')
            ->where([
                'type' => 'music_kit',
                'type_id' => $music_id
            ]);

        $music_genre = FrontMusicKitController::joinArtist($music_id)
            ->whereIn('music_kits.id', RelationshipGenre::select('type_id')
                ->where('type', 'music_kit')
                ->whereIn('genre_id', $genre_ids));

        $music_theme = FrontMusicKitController::joinArtist($music_id)
            ->whereIn('music_kits.id', RelationshipTheme::select('type_id')
                ->where('type', 'music_kit')
                ->whereIn('theme_id', $theme_id));

        $music_instrument = FrontMusicKitController::joinArtist($music_id)
            ->whereIn('music_kits.id', RelationshipInstrument::select('type_id')
                ->where('type', 'music_kit')
                ->whereIn('instrument_id', $instrument_ids));


        $music_mood = FrontMusicKitController::joinArtist($music_id)
            ->whereIn('music_kits.id', RelationshipMood::select('type_id')
                ->where('type', 'music_kit')
                ->whereIn('mood_id', $mood_ids));

        $music_list = FrontMusicKitController::joinArtist($music_id)
            ->union($music_genre)
            ->union($music_theme)
            ->union($music_instrument)
            ->union($music_mood)
            ->paginate(8);

        return $music_list;
    }

    public static function joinArtist(int $music_kit_id)
    {
        return MusicKit::select(
            'music_artists.name as music_artist_name',
            'music_kits.*'
        )
            ->join('music_artists', 'music_kits.music_artist_id', '=', 'music_artists.id')
            ->where('music_kits.id', '!=', $music_kit_id);
    }
}
