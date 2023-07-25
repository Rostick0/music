<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function create(int $music_id)
    {
        Favorite::firstOrCreate([
            'music_id' => $music_id,
            'users_id' => auth()->id()
        ]);

        return back();
    }

    public static function countMy()
    {
        $user_id = auth()->id();

        if (!$user_id) return null;

        return Favorite::where('users_id', $user_id)->count();
    }

    public function destroy(int $id)
    {
        Favorite::destroy($id);

        return back();
    }
}
