<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class FrontPlaylistController extends Controller
{
    public static function getById(int $id)
    {
        $playlist_model = Playlist::where('id', $id);

        if (!(auth()->check() && auth()->user()->is_admin)) $playlist_model->where('is_active', 1);

        $playlist = $playlist_model->first();

        return $playlist ?? abort(404);
    }
}
