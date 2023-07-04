<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\Mood;
use App\Models\MusicPlaylist;
use App\Models\Playlist;
use App\Models\RelationshipInstrument;
use App\Models\RelationshipMood;
use App\Models\RelationshipTheme;
use App\Models\Theme;
use Illuminate\Http\Request;

class MusicPlaylistController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:65536',
            'image' => 'image|mimes:jpeg,png,jpg'
        ]);

        $image = NULL;

        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = time() . '.' . $extension;
            $request->file('image')->storeAs('public/upload/image', $image);
        }

        $playlist = Playlist::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $image,
            'is_active' => $request->has('is_active')
        ]);

        $instruments = explode(',', $request->instruments);
        foreach ($instruments as $instrument) {
            if (!trim($instrument)) continue;

            $value_instrument = Instrument::firstOrCreate([
                'name' => trim(mb_strtolower($instrument))
            ]);

            RelationshipInstrument::firstOrCreate([
                'type' => 'playlist',
                'type_id' => $playlist->id,
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
                'type' => 'playlist',
                'type_id' => $playlist->id,
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
                'type' => 'playlist',
                'type_id' => $playlist->id,
                'themes_id' => $value_theme->id
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MusicPlaylist $musicPlaylist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MusicPlaylist $musicPlaylist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MusicPlaylist $musicPlaylist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MusicPlaylist $musicPlaylist)
    {
        //
    }
}
