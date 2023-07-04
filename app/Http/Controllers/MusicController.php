<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Instrument;
use App\Models\Mood;
use App\Models\Music;
use App\Models\MusicArtist;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();

        return view('music_add', [
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
            // 'is_active' => 'required',
            // 'is_free' => 'required',
            'description' => 'max:65536',
            'image' => 'image|mimes:jpeg,png,jpg',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $music_artists = MusicArtist::firstOrCreate([
            'name' => $request->music_artists
        ]);

        // dd($music_artists->id);

        $image = NULL;

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = time() . '.' . $extension;
            $request->file('image')->storeAs('public/upload/image', $image);
        }

        $music = Music::create([
            'music_artists_id' => $music_artists->id,
            'title' => $request->title,
            'link' => $request->link,
            'link_demo' => $request->link_demo,
            'publisher' => $request->publisher ?? NULL,
            'distr' => $request->distr,
            'genres_id' => $request->genres_id,
            'is_active' => $request->has('is_active'),
            'is_free' => $request->has('is_free'),
            'description' => $request->description ?? NULL,
            'image' => $image,
            'seo_title' => $request->seo_title ?? NULL,
            'seo_description' => $request->seo_description ?? NULL,
        ]);

        $instruments = explode(',', $request->instruments);
        foreach ($instruments as $instrument) {
            if (!trim($instrument)) continue;

            $value_instrument = Instrument::firstOrCreate([
                'name' => trim(mb_strtolower($instrument))
            ]);

            RelationshipInstrument::firstOrCreate([
                'type' => 'music',
                'type_id' => $music->id,
                'instruments_id' => $value_instrument->id,
            ]);
        }

        $moods = explode(',', $request->moods);
        foreach ($moods as $mood) {
            if (!trim($mood)) continue;

            $value_mood = Mood::firstOrCreate([
                'name' => trim(mb_strtolower($mood))
            ]);

            RelationshipMood::firstOrCreate([
                'type' => 'music',
                'type_id' => $music->id,
                'moods_id' => $value_mood->id,
            ]);
        }

        $themes = explode(',', $request->themes);
        foreach ($themes as $theme) {
            if (!trim($theme)) continue;

            $value_theme = Theme::firstOrCreate([
                'name' => trim(mb_strtolower($theme))
            ]);

            RelationshipTheme::firstOrCreate([
                'type' => 'music',
                'type_id' => $music->id,
                'themes_id' => $value_theme->id
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Music $music)
    {
        $music_list = Music::paginate(20);

        return view('music_list', [
            'music_list' => $music_list
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Music $music)
    {
        return view('music');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = $request->validate([
            'music_artists_id' => 'required' . Rule::exists('music_artists', 'id'),
            'title' => 'required|max:255',
            'link' => 'required|max:255',
            'link_demo' => 'required|max:255',
            'publisher' => 'max:255',
            'distr' => 'max:255',
            'genres_id' => 'required|' . Rule::exists('genres', 'id'),
            'is_active' => 'required|in:0,1',
            'is_free' => 'required|in:0,1',
            'description' => 'max:65536',
            'image' => 'image|mimes:jpeg,png,jpg',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $music_db = Music::find($id);

        $image = $music_db->image;

        if ($request->file('image')) {
            if (Storage::exists('public/upload/image' . $image)) Storage::delete('public/upload/image' . $image);

            $extension = $request->file('image')->getClientOriginalExtension();
            $image = time() . '.' . $extension;
            $request->file('image')->storeAs('public/upload/image', $image);
        }

        $music = $music_db->update([
            'music_artists_id' => $request->music_artists_id,
            'title' => $request->title,
            'link' => $request->link,
            'link_demo' => $request->link_demo,
            'publisher' => $request->publisher ?? NULL,
            'distr' => $request->distr,
            'genres_id' => $request->genres_id,
            'is_active' => $request->is_active,
            'is_free' => $request->is_free,
            'description' => $request->description ?? NULL,
            'image' => $image,
            'seo_title' => $request->seo_title ?? NULL,
            'seo_description' => $request->seo_description ?? NULL,
        ]);

        $instruments = $request->instruments;
        foreach ($instruments as $instrument) {
            $value_instrument = Instrument::firstOrCreate([
                'name' => mb_strtolower($instrument)
            ]);

            $music->music_instruments()->firstOrCreate([
                'name' => $value_instrument->name
            ]);
        }

        $moods = $request->moods;
        foreach ($moods as $mood) {
            $value_mood = Mood::firstOrCreate([
                'name' => mb_strtolower($mood)
            ]);

            $music->music_moods()->firstOrCreate([
                'name' => $value_mood->name
            ]);
        }

        $themes = $request->themes;
        foreach ($themes as $theme) {
            $value_theme = Mood::firstOrCreate([
                'name' => mb_strtolower($theme)
            ]);

            $music->music_themes()->firstOrCreate([
                'name' => $value_theme->name
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Music $music)
    {
        //
    }
}
