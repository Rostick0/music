<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Music;
use App\Models\MusicArtist;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $music_list = Music::select(
            'music.*',
            'genres.name as genre_name'
        )
            ->join('genres', 'music.genres_id', '=', 'genres.id')
            ->paginate(20);

        return view('admin.music_list', [
            'music_list' => $music_list
        ]);
    }

    public function index_client()
    {
        $music_list = Music::paginate(20);

        return view('client.music_list', [
            'music_list' => $music_list
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();

        return view('admin.music_create', [
            'genres' => $genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'music_artists' => 'required',
            'title' => 'required|max:255',
            'link' => 'required|max:255',
            'link_demo' => 'required|max:255',
            'publisher' => 'max:255',
            'distr' => 'max:255',
            'date' => 'date',
            'genres_id' => 'required|' . Rule::exists('genres', 'id'),
            'description' => 'max:65536',
            'image' => 'image|mimes:jpeg,png,jpg',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $music_artists = MusicArtist::firstOrCreate([
            'name' => trim($request->music_artists)
        ]);

        $image = ImageController::upload($request->file('image'));

        $music = Music::create([
            'music_artists_id' => $music_artists->id,
            'title' => $request->title,
            'link' => $request->link,
            'link_demo' => $request->link_demo,
            'publisher' => $request->publisher ?? NULL,
            'distr' => $request->distr,
            'genres_id' => $request->genres_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_free' => $request->has('is_free') ? 1 : 0,
            'description' => $request->description ?? NULL,
            'image' => $image,
            'seo_title' => $request->seo_title ?? NULL,
            'seo_description' => $request->seo_description ?? NULL,
        ]);

        RelationshipInstrumentController::createRelationship($request->instruments, $music->id, 'music');
        RelationshipMoodController::createRelationship($request->moods, $music->id, 'music');
        RelationshipThemeController::createRelationship($request->themes, $music->id, 'music');

        return redirect()->route('music.edit', [
            'id' => $music->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Music $music)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $music = Music::findOrFail($id);
        $music_artist = MusicArtist::find($music->id);

        $themes = RelationshipThemeController::get($music->id, 'music');
        $moods = RelationshipMoodController::get($music->id, 'music');
        $instruments = RelationshipInstrumentController::get($music->id, 'music');
        $genres = Genre::all();

        return view('admin.music_edit', [
            'music' => $music,
            'music_artist' => $music_artist,
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
            'music_artists' => 'required',
            'title' => 'required|max:255',
            'link' => 'required|max:255',
            'link_demo' => 'required|max:255',
            'publisher' => 'max:255',
            'distr' => 'max:255',
            'date' => 'date',
            'genres_id' => 'required|' . Rule::exists('genres', 'id'),
            'description' => 'max:65536',
            'image' => 'image|mimes:jpeg,png,jpg',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $music_artists = MusicArtist::firstOrCreate([
            'name' => trim($request->music_artists)
        ]);

        $image = ImageController::upload($request->file('image'));

        $update_data = [
            'music_artists_id' => $music_artists->id,
            'title' => $request->title,
            'link' => $request->link,
            'link_demo' => $request->link_demo,
            'publisher' => $request->publisher ?? NULL,
            'distr' => $request->distr,
            'genres_id' => $request->genres_id,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'is_free' => $request->has('is_free') ? 1 : 0,
            'description' => $request->description ?? NULL,
            'seo_title' => $request->seo_title ?? NULL,
            'seo_description' => $request->seo_description ?? NULL,
        ];

        if ($image) {
            $update_data['image'] = $image;
        }

        Music::find($id)->update($update_data);

        RelationshipInstrumentController::createAndDeleteRelationship($request->instruments, $id, 'music');
        RelationshipMoodController::createAndDeleteRelationship($request->moods, $id, 'music');
        RelationshipThemeController::createAndDeleteRelationship($request->themes, $id, 'music');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        //
    }
}
