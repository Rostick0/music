<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Instrument;
use App\Models\Mood;
use App\Models\Music;
use App\Models\Playlist;
use App\Models\RelationshipGenre;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipPlaylist;
use App\Models\RelationshipTheme;
use App\Models\Theme;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;

class RelationshipPlaylistController extends Controller
{
    public function music_list(Request $request, int $playlist_id)
    {
        if (Playlist::find($playlist_id)->count() < 1) return abort(404);

        $music_list = RelationshipPlaylistController::search($request, $playlist_id);

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

    public function music_add(int $playlist_id, int $music_id)
    {
        RelationshipPlaylist::firstOrCreate([
            'music_id' => $music_id,
            'playlist_id' => $playlist_id,
        ]);

        return redirect()->route('playlist.edit', [
            'id' => $playlist_id
        ]);
    }

    public function music_remove($id)
    {
        $relationship_playlist = RelationshipPlaylist::find($id);
        $relationship_playlist->destroy($id);
        
        return redirect()->route('playlist.edit', [
            'id' => $relationship_playlist->playlist_id
        ]);
    }

    public static function search(Request $request, int $playlist_id)
    {
        $where_sql = [];
        if ($request->title) $where_sql[] = ['music.title', 'LIKE', '%' . $request->title . '%'];
        if ($request->music_artists) $where_sql[] = ['music_artists.name', 'LIKE', '%' . $request->music_artists . '%'];

        $music_list = Music::select(
            'music.*',
            'music_artists.name as music_artist_name',
            'favorites.id as favorite_id'
        )
            ->join('music_artists', 'music.music_artist_id', '=', 'music_artists.id')
            ->leftJoin('favorites', function (JoinClause $join) {
                $join->on('favorites.music_id', '=', 'music.id')
                    ->where('favorites.user_id', auth()->id());
            })
            ->where($where_sql)
            ->orderByDesc('id');
        if ($request->genres) {
            $music_list->whereIn('music.id', RelationshipGenre::select('type_id')
                ->where('type', 'music')
                ->whereIn('genre_id', is_array($request->genres) ? $request->genres : [$request->genres])
                ->get());
        }
        if ($request->themes) {
            $music_list->whereIn('music.id', RelationshipTheme::select('type_id')
                ->where('type', 'music')
                ->whereIn('theme_id', is_array($request->themes) ? $request->themes : [$request->themes])
                ->get());
        }
        if ($request->instruments) {
            $music_list->whereIn('music.id', RelationshipInstrument::select('type_id')
                ->where('type', 'music')
                ->whereIn('instrument_id', is_array($request->instruments) ? $request->instruments : [$request->instruments])
                ->get());
        }
        if ($request->moods) {
            $music_list->whereIn('music.id', RelationshipMood::select('type_id')
                ->where('type', 'music')
                ->whereIn('mood_id', is_array($request->moods) ? $request->moods : [$request->moods])
                ->get());
        }
        if (RelationshipPlaylist::select('music_id')->where('playlist_id', $playlist_id)->count()) {
            $music_list->whereNotIn('music.id', RelationshipPlaylist::select('music_id')
                ->where('playlist_id', $playlist_id)
                ->get());
        }


        $music_list = $music_list->paginate(app('site')->count_admin);


        return $music_list;
    }
}
