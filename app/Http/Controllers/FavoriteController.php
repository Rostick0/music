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

    public static function getMusic()
    {
        if (auth()->check()) {
            $music_list = Favorite::selectMusic(new Music, 'music', 'music')
                ->union(
                    Favorite::selectMusic(new MusicKit, 'music_kits', 'music_kit')
                )
                ->union(
                    Favorite::selectMusicPart('music', 'music')
                )
                ->union(
                    Favorite::selectMusicPart('music_kits', 'music_kit')
                )
                ->orderByDesc('id')
                ->paginate(app('site')->count_front);


            // dd($music_list);
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

        $music_list = Favorite::selectNoAuth(new Music, 'music', 'music', $music_ids)
            ->union(
                Favorite::selectNoAuth(new MusicKit, "music_kits",  'music_kit', $music_kit_ids)
            )
            ->union(
                Favorite::selectMusicPartNoAuth('music', 'music', $music_part_ids)
            )
            ->union(
                Favorite::selectMusicPartNoAuth('music_kits', 'music_kit', $music_part_ids)
            )
            ->orderByDesc('id')
            ->paginate(app('site')->count_front);

        return $music_list;
    }

    public static function countMy()
    {
        $user_id = auth()->id();

        if (!$user_id) return count(FavoriteController::getLocalFavorite());

        // dd(Favorite::where('user_id', $user_id)->get());

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
                ['type_id', '=', $request->type_id],
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
