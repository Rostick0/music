<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\MusicKit;
use App\Models\RelationshipGenre;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

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

    public function search(Request $request, $type = 'json')
    {
        $where_sql = [];
        if ($request->title) $where_sql[] = ['music_kits.title', 'LIKE', '%' . $request->title . '%'];
        if ($request->music_artists) $where_sql[] = ['music_artists.name', 'LIKE', '%' . $request->music_artists . '%'];
        if (!(auth()->check() && auth()->user()->is_admin)) $where_sql[] = ['music_kits.is_active', '=', 1];

        if ($request->count && $request->count > app('site')->count_front) {
            $count = app('site')->count_front;
        } else {
            $count = $request->count ?? app('site')->count_front;
        }

        $music_kits = MusicKit::select(
            'music_kits.*',
            'music_artists.name as music_artist_name',
        )
            ->join('music_artists', 'music_kits.music_artist_id', '=', 'music_artists.id')
            ->where($where_sql)
            ->orderByDesc('id');
        if ($request->genres) {
            $music_kits->whereIn('music_kits.id', RelationshipGenre::select('type_id')
                ->where('type', 'music_kit')
                ->whereIn('genre_id', is_array($request->genres) ? $request->genres : [$request->genres])
                ->get());
        }
        if ($request->themes) {
            $music_kits->whereIn('music_kits.id', RelationshipTheme::select('type_id')
                ->where('type', 'music_kit')
                ->whereIn('theme_id', is_array($request->themes) ? $request->themes : [$request->themes])
                ->get());
        }
        if ($request->instruments) {
            $music_kits->whereIn('music_kits.id', RelationshipInstrument::select('type_id')
                ->where('type', 'music_kit')
                ->whereIn('instrument_id', is_array($request->instruments) ? $request->instruments : [$request->instruments])
                ->get());
        }
        if ($request->moods) {
            $music_kits->whereIn('music_kits.id', RelationshipMood::select('type_id')
                ->where('type', 'music_kit')
                ->whereIn('mood_id', is_array($request->moods) ? $request->moods : [$request->moods])
                ->get());
        }

        $music_kits = $music_kits->paginate($count);

        if ($type === 'json') return response(
            [
                'data' => $music_kits,
                'links_html' => Blade::compileString($music_kits->appends($request->all())->links('vendor.front-pagination'))
            ]
        );

        return $music_kits;
    }
}
