<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Music;
use App\Models\MusicKit;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class FavoriteController extends Controller
{
    private static function getLocalFavorite()
    {
        return json_decode(Cookie::get('favorite')) ?? [];
    }

    public static function insertDb()
    {
        $local_favorite = FavoriteController::getLocalFavorite();

        if (empty($local_favorite)) return;

        foreach ($local_favorite as $favorite) {
            Favorite::firstOrCreate([
                'type_id' => $favorite->id,
                'type' => $favorite->type,
                'user_id' => auth()->id()
            ]);
        }
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'type_id' => 'required|numeric',
            'type' => 'required|in:music,music_kit'
        ]);

        $cookie = null;

        if (auth()->check()) {
            Favorite::firstOrCreate([
                ...$validated,
                'user_id' => auth()->id()
            ]);
        } else {
            $local = FavoriteController::getLocalFavorite();

            if (!in_array($validated, $local)) {
                array_push($local, $validated);

                $cookie = cookie('favorite', json_encode($local));
            }
        }

        $response = back();

        if ($cookie) $response->cookie($cookie);

        return $response;
    }

    public static function getMusic()
    {
        if (auth()->check()) {
            $music_list = Music::select(
                'music.*',
                'music_artists.name as music_artist_name',
                'favorites.id as favorite_id'
            )
                ->join('music_artists', 'music.music_artist_id', '=', 'music_artists.id')
                ->join('favorites', function (JoinClause $join) {
                    $join->on('favorites.type_id', '=', 'music.id')
                        ->where('favorites.type', 'music')
                        ->where('favorites.user_id', auth()->id());
                })
                ->union(
                    MusicKit::select(
                        'music_kits.*',
                        'music_artists.name as music_artist_name',
                        'favorites.id as favorite_id'
                    )
                        ->join('music_artists', 'music_kits.music_artist_id', '=', 'music_artists.id')
                        ->join('favorites', function (JoinClause $join) {
                            $join->on('favorites.type_id', '=', 'music_kits.id')
                                ->where('favorites.type', 'music_kit')
                                ->where('favorites.user_id', auth()->id());
                        })
                )
                ->paginate(app('site')->count_front);

            return $music_list;
        }

        $local_favorite = FavoriteController::getLocalFavorite();

        $music_ids = array_map(function ($item) {
            if ($item?->type == 'music') return $item?->type_id;
        }, [...$local_favorite]);

        $music_kit_ids = array_map(function ($item) {
            if ($item?->type == 'music_kit') return $item?->type_id;
        }, [...$local_favorite]);

        $music_list = Music::select(
            'music.*',
            'music_artists.name as music_artist_name',
            DB::raw("'music' as `table_type`"),
        )
            ->join('music_artists', 'music.music_artist_id', '=', 'music_artists.id')
            ->whereIn('music.id', $music_ids)
            ->union(
                MusicKit::select(
                    'music_kits.*',
                    'music_artists.name as music_artist_name',
                    DB::raw("'music_kit' as `table_type`"),
                )
                    ->join('music_artists', 'music_kits.music_artist_id', '=', 'music_artists.id')
                    ->whereIn('music_kits.id', $music_kit_ids)
            )
            ->paginate(app('site')->count_front);

        return $music_list;
    }

    public static function countMy()
    {
        $user_id = auth()->id();

        if (!$user_id) return count(FavoriteController::getLocalFavorite());

        return Favorite::where('user_id', $user_id)->count();
    }

    public function destroy(Request $request)
    {
        $validated = $request->validate([
            'type_id' => 'required|numeric',
            'type' => 'required|in:music,music_kit'
        ]);

        $cookie = null;

        if (auth()->check()) {
            Favorite::where([
                ['type_id', '=', $request->type],
                ['type', '=', $request->type],
                ['user_id', '=', auth()->id()]
            ])->delete();
        } else {
            $local = FavoriteController::getLocalFavorite();

            $index = array_search($validated, $local);
            if ($index !== false) array_splice($local, $index, 1);

            $cookie =  cookie('favorite', json_encode($local));
        }

        $response = back();

        if ($cookie) $response->cookie($cookie);

        return $response;
    }
}
