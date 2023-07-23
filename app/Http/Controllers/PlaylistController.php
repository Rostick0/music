<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Instrument;
use App\Models\Mood;
use App\Models\Playlist;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $where_sql = [];
        if ($request->title) $where_sql[] = ['playlists.title', 'LIKE', '%' . $request->title . '%'];
        if ($request->genres_id) $where_sql[] = ['playlists.genres_id', '=', $request->genres_id];

        $playlists = Playlist::select(
            'playlists.*',
            'genres.name as genre_name',
        )
            ->join('genres', 'playlists.genres_id', '=', 'genres.id')
            ->where($where_sql);
        if ($request->themes) {
            $playlists->whereIn('playlists.id', RelationshipTheme::select('type_id')
                ->where('type', 'playlist')
                ->whereIn('themes_id', $request->themes)
                ->get());
        }
        if ($request->instruments) {
            $playlists->whereIn('playlists.id', RelationshipInstrument::select('type_id')
                ->where('type', 'playlist')
                ->whereIn('instruments_id', $request->instruments)
                ->get());
        }
        if ($request->moods) {
            $playlists->whereIn('playlists.id', RelationshipMood::select('type_id')
                ->where('type', 'playlist')
                ->whereIn('moods_id', $request->moods)
                ->get());
        }
        $playlists = $playlists->paginate(20);

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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();

        return view('admin.playlist_create', [
            'genres' => $genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'max:255',
            'image' => 'image|mimes:jpeg,png,jpg',
            'description' => 'max:65536',
            'genres_id' => 'required|' . Rule::exists('genres', 'id'),
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $image = ImageController::upload($request->file('image'));

        $playlist = Playlist::create([
            'title' => $request->title,
            'image' => $image,
            'description' => $request->description,
            'genres_id' => $request->genres_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ]);

        RelationshipInstrumentController::createAndDeleteRelationship($request->instruments, $playlist->id, 'playlist');
        RelationshipMoodController::createAndDeleteRelationship($request->moods, $playlist->id, 'playlist');
        RelationshipThemeController::createAndDeleteRelationship($request->themes, $playlist->id, 'playlist');

        return redirect()->route('playlist.edit', [
            'id' => $playlist->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Playlist $playlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $playlist = Playlist::findOrFail($id);

        $themes = RelationshipThemeController::get($playlist->id, 'playlist');
        $moods = RelationshipMoodController::get($playlist->id, 'playlist');
        $instruments = RelationshipInstrumentController::get($playlist->id, 'playlist');
        $genres = Genre::all();

        return view('admin.playlist_edit', [
            'playlist' => $playlist,
            'themes' => implode(', ', $themes),
            'moods' => implode(', ', $moods),
            'instruments' => implode(', ', $instruments),
            'genres' => $genres,
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
            'genres_id' => 'required|' . Rule::exists('genres', 'id'),
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $image = ImageController::upload($request->file('image'));

        $update_data = [
            'title' => $request->title,
            'description' => $request->description,
            'genres_id' => $request->genres_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ];

        if ($image) {
            $update_data['image'] = $image;
        }

        Playlist::find($id)->update($update_data);

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
