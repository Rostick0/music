<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Music;
use App\Models\MusicKit;
use App\Models\MusicPart;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
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
            'type' => 'required|in:music,music_kit,part'
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

    public static function selectNoAuth(Model $model, $table_name, $table_type, $ids)
    {
        return $model::select(
            "$table_name.*",
            'music_artists.name as music_artist_name',
            DB::raw("NULL as `type`"),
            DB::raw("NULL as `type_id`"),
            DB::raw("'$table_type' as `table_type`"),
        )
            ->join('music_artists', "$table_name.music_artist_id", '=', 'music_artists.id')
            ->whereIn("$table_name.id", $ids);
    }

    public static function selectMusicPartNoAuth(string $table_name, $table_type, $ids)
    {
        return MusicPart::select(
            "music_parts.id as id",
            "music_parts.music_artist_id as music_artist_id",
            "music_parts.title as title",
            "music_parts.link as link",
            DB::raw("NULL as `link_demo`"),
            DB::raw("NULL as `publisher`"),
            DB::raw("NULL as `distr`"),
            DB::raw("NULL as `is_active`"),
            DB::raw("NULL as `is_free`"),
            DB::raw("NULL as `description`"),
            "$table_name.image as image",
            "music_parts.duration as duration",
            DB::raw("NULL as `seo_title`"),
            DB::raw("NULL as `seo_description`"),
            "music_parts.created_at as created_at",
            "music_parts.updated_at as updated_at",
            'music_artists.name as music_artist_name',
            "music_parts.type as type",
            "music_parts.type_id as type_id",
            DB::raw("'muisc_part' as `table_type`"),
        )
            ->join('music_artists', "music_parts.music_artist_id", '=', 'music_artists.id')
            ->join($table_name, "$table_name.id", '=', 'music_parts.type_id')
            ->whereIn("music_parts.id", $ids)
            ->where('music_parts.type', $table_type);
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
                ->union(
                    MusicPart::select(
                        'music_parts.*',
                        'music_artists.name as music_artist_name',
                        'favorites.id as favorite_id'
                    )
                        ->join('music_artists', 'music_parts.music_artist_id', '=', 'music_artists.id')
                        ->join('favorites', function (JoinClause $join) {
                            $join->on('favorites.type_id', '=', 'music_parts.id')
                                ->where('favorites.type', 'music_parts')
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

        $music_part_ids = array_map(function ($item) {
            if ($item?->type == 'part') return $item?->type_id;
        }, [...$local_favorite]);

        $music_list = FavoriteController::selectNoAuth(new Music, 'music', 'music', $music_ids)
            ->union(
                FavoriteController::selectNoAuth(new MusicKit, "music_kits",  'music_kit', $music_kit_ids)
            )
            ->union(
                FavoriteController::selectMusicPartNoAuth('music', 'music', $music_part_ids)
            )
            ->union(
                FavoriteController::selectMusicPartNoAuth('music_kits', 'music_kit', $music_part_ids)
            )
            ->orderByDesc('id')
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
            'type' => 'required|in:music,music_kit,part'
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

            $index = array_search((object) $validated, $local);
            if ($index !== false) array_splice($local, $index, 1);

            $cookie =  cookie('favorite', json_encode($local));
        }

        $response = back();

        if ($cookie) $response->cookie($cookie);

        return $response;
    }
}
