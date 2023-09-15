<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Instrument;
use App\Models\Mood;
use App\Models\Playlist;
use App\Models\RelationshipGenre;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipPlaylist;
use App\Models\RelationshipTheme;
use App\Models\Theme;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Validation\Rule;

class PlaylistController extends Controller
{
    public function index(Request $request)
    {
        $where_sql = [];
        if ($request->title) $where_sql[] = ['title', 'LIKE', '%' . $request->title . '%'];

        $playlists = Playlist::where($where_sql)
            ->orderByDesc('id');
        if ($request->themes) {
            $playlists->whereIn('playlists.id', RelationshipTheme::select('type_id')
                ->where('type', 'playlist')
                ->whereIn('theme_id', $request->themes)
                ->get());
        }
        if ($request->instruments) {
            $playlists->whereIn('playlists.id', RelationshipInstrument::select('type_id')
                ->where('type', 'playlist')
                ->whereIn('instrument_id', $request->instruments)
                ->get());
        }
        if ($request->moods) {
            $playlists->whereIn('playlists.id', RelationshipMood::select('type_id')
                ->where('type', 'playlist')
                ->whereIn('mood_id', $request->moods)
                ->get());
        }
        $playlists = $playlists->paginate(app('site')->count_admin ?? 20);

        $genres = Genre::all();
        $themes = Theme::all();
        $instruments = Instrument::all();
        $moods = Mood::all();

        return view('admin.playlist_list', [
            'playlists' => $playlists,
            'genres' => $genres,
            'themes' => $themes,
            'instruments' => $instruments,
            'moods' => $moods
        ]);
    }

    public function search(Request|null $request, $type = 'json')
    {
        $where_sql = [];
        if ($request?->title) $where_sql[] = ['title', 'LIKE', '%' . $request->title . '%'];
        if (!(auth()->check() && auth()->user()->is_admin)) $where_sql[] = ['is_active', '=', 1];

        if ($request?->count && $request?->count > app('site')->count_front) {
            $count = app('site')->count_front;
        } else {
            $count = $request->count ?? app('site')->count_front;
        }

        $playlists = Playlist::where($where_sql)
            ->orderByDesc('id');
        if ($request?->genres) {
            $playlists->whereIn('id', RelationshipGenre::select('type_id')
                ->where('type', 'playlist')
                ->whereIn('genre_id', is_array($request->genres) ? $request->genres : [$request->genres])
                ->get());
        }
        if ($request?->themes) {
            $playlists->whereIn('id', RelationshipTheme::select('type_id')
                ->where('type', 'playlist')
                ->whereIn('theme_id', is_array($request->themes) ? $request->themes : [$request->themes])
                ->get());
        }
        if ($request?->instruments) {
            $playlists->whereIn('id', RelationshipInstrument::select('type_id')
                ->where('type', 'playlist')
                ->whereIn('instrument_id', is_array($request->instruments) ? $request->instruments : [$request->instruments])
                ->get());
        }
        if ($request?->moods) {
            $playlists->whereIn('id', RelationshipMood::select('type_id')
                ->where('type', 'playlist')
                ->whereIn('mood_id', is_array($request->moods) ? $request->moods : [$request->moods])
                ->get());
        }
        $playlists = $playlists->paginate($count);

        if ($type === 'json') return response([
            'data' => $playlists,
            'links_html' => Blade::compileString($playlists->appends($request->all())->links('vendor.front-pagination'))
        ]);

        return $playlists;
    }

    public function create()
    {
        $genres = Genre::all();
        $themes = Theme::all();
        $moods = Mood::all();
        $instruments = Instrument::all();

        return view('admin.playlist_create', [
            'genres' => $genres,
            'themes' => $themes,
            'moods' => $moods,
            'instruments' => $instruments,
        ]);
    }

    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'max:255',
            'image' => 'image|mimes:jpeg,png,jpg',
            'description' => 'max:65536',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $image = ImageController::upload($request->file('image'));

        $playlist = Playlist::create([
            'title' => $request->title,
            'image' => $image,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ]);

        RelationshipGenreController::createAndDeleteRelationship($request->genres, $playlist->id, 'playlist');
        RelationshipInstrumentController::createAndDeleteRelationship($request->instruments, $playlist->id, 'playlist');
        RelationshipMoodController::createAndDeleteRelationship($request->moods, $playlist->id, 'playlist');
        RelationshipThemeController::createAndDeleteRelationship($request->themes, $playlist->id, 'playlist');

        return redirect()->route('playlist.edit', [
            'id' => $playlist->id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $playlist = Playlist::findOrFail($id);

        $genres = Genre::select(
            'genres.*',
            'relationship_genres.id as relationship_id'
        )->leftJoin('relationship_genres', function ($join) use ($playlist) {
            $join->on('relationship_genres.genre_id', '=', 'genres.id')
                ->where([
                    ['type_id', '=', $playlist->id],
                    ['type', '=', 'playlist']
                ]);
        })->get();

        $themes = Theme::select(
            'themes.*',
            'relationship_themes.id as relationship_id'
        )->leftJoin('relationship_themes', function ($join) use ($playlist) {
            $join->on('relationship_themes.theme_id', '=', 'themes.id')
                ->where([
                    ['type_id', '=', $playlist->id],
                    ['type', '=', 'playlist']
                ]);
        })->get();

        $moods = Mood::select(
            'moods.*',
            'relationship_moods.id as relationship_id'
        )->leftJoin('relationship_moods', function ($join) use ($playlist) {
            $join->on('relationship_moods.mood_id', '=', 'moods.id')
                ->where([
                    ['type_id', '=', $playlist->id],
                    ['type', '=', 'playlist']
                ]);
        })->get();

        $instruments = Instrument::select(
            'instruments.*',
            'relationship_instruments.id as relationship_id'
        )->leftJoin('relationship_instruments', function ($join) use ($playlist) {
            $join->on('relationship_instruments.instrument_id', '=', 'instruments.id')
                ->where([
                    ['type_id', '=', $playlist->id],
                    ['type', '=', 'playlist']
                ]);
        })->get();

        return view('admin.playlist_edit', [
            'playlist' => $playlist,
            'genres' => $genres,
            'themes' => $themes,
            'moods' => $moods,
            'instruments' => $instruments,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = $request->validate([
            'title' => 'max:255',
            'image' => 'image|mimes:jpeg,png,jpg',
            'description' => 'max:65536',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $image = ImageController::upload($request->file('image'));

        $update_data = [
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ];

        if ($image) $update_data['image'] = $image;

        Playlist::find($id)->update($update_data);

        RelationshipGenreController::createAndDeleteRelationship($request->genres, $id, 'playlist');
        RelationshipInstrumentController::createAndDeleteRelationship($request->instruments, $id, 'playlist');
        RelationshipMoodController::createAndDeleteRelationship($request->moods, $id, 'playlist');
        RelationshipThemeController::createAndDeleteRelationship($request->themes, $id, 'playlist');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $playlist = Playlist::find($id);
        ImageController::destroy($playlist->image);
        $delete = Playlist::destroy($id);

        return redirect(route('deleted', [
            'text' => 'Плейлист удален ' . $playlist->name
        ]));
    }
}
