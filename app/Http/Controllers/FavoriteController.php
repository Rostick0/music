<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Music;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class FavoriteController extends Controller
{
    private static function getLocalFavorite()
    {
        return json_decode(Cookie::get('favorite')) ?? [];
    }

    public function create(int $music_id)
    {
        $cookie = null;

        if (auth()->check()) {
            Favorite::firstOrCreate([
                'music_id' => $music_id,
                'users_id' => auth()->id()
            ]);
        } else {
            $ids = FavoriteController::getLocalFavorite();

            if (!in_array($music_id, $ids)) {
                array_push($ids, $music_id);

                $cookie = cookie('favorite', json_encode($ids));
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
            )
                ->join('music_artists', 'music.music_artists_id', '=', 'music_artists.id')
                ->join('favorites', function (JoinClause $join) {
                    $join->on('favorites.music_id', '=', 'music.id')
                        ->where('favorites.users_id', auth()->id());
                })
                ->paginate(app('site')->count_front);

            return $music_list;
        }

        $local_favorite = FavoriteController::getLocalFavorite();

        $music_list = Music::select(
            'music.*',
            'music_artists.name as music_artist_name',
        )
            ->join('music_artists', 'music.music_artists_id', '=', 'music_artists.id')
            ->whereIn('music.id', $local_favorite)
            ->paginate(app('site')->count_front);

        return $music_list;
    }

    public static function countMy()
    {
        $user_id = auth()->id();

        if (!$user_id) return count(FavoriteController::getLocalFavorite());

        return Favorite::where('users_id', $user_id)->count();
    }

    public function destroy(int $id)
    {
        $cookie = null;

        if (auth()->check()) {
            Favorite::destroy($id);
        } else {
            $ids = FavoriteController::getLocalFavorite();

            $index = array_search($id, $ids);
            if ($index !== false) array_splice($ids, $index, 1);

            $cookie =  cookie('favorite', json_encode($ids));
        }

        $response = back();

        if ($cookie) $response->cookie($cookie);

        return $response;
    }
}
