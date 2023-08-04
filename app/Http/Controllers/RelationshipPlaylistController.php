<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Instrument;
use App\Models\Mood;
use App\Models\Playlist;
use App\Models\RelationshipPlaylist;
use App\Models\Theme;
use Illuminate\Http\Request;

class RelationshipPlaylistController extends Controller
{
    // id => playlist_id
    public function music_list(Request $request, int $playlist_id)
    {
        if (Playlist::find($playlist_id)->count() < 1) return abort(404);

        $music_controller = new MusicController();

        $music_list = $music_controller->search($request, '');

        $genres = Genre::all();
        $themes = Theme::all();
        $instruments = Instrument::all();
        $moods = Mood::all();

        return view('admin.playlist_music_list', [
            'id' => $playlist_id,
            'music_list' => $music_list,
            'genres' => $genres,
            'themes' => $themes,
            'instruments' => $instruments,
            'moods' => $moods
        ]);
    }

    // id => playlist_id
    public function music_add(int $playlist_id, int $music_id)
    {
        RelationshipPlaylist::firstOrCreate([
            'music_id' => $music_id,
            'playlist_id' => $playlist_id,
        ]);

        redirect()->route('playlist.edit', [
            'id' => $playlist_id
        ]);
    }

    // id => relationship_playlist id
    public function music_remove($id)
    {
        RelationshipPlaylist::destroy($id);

        return back();
    }
}
