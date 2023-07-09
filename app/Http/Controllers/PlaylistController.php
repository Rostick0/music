<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Playlist;
use App\Models\RelationshipInstrument;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlaylistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.playlist_list');
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
    public function destroy(Playlist $playlist)
    {
        //
    }
}
