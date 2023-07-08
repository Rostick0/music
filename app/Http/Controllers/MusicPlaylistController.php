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
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        RelationshipInstrumentController::createRelationship($request->instruments, $playlist->id, 'playlist');
        RelationshipMoodController::createRelationship($request->moods, $playlist->id, 'playlist');
        RelationshipThemeController::createRelationship($request->themes, $playlist->id, 'playlist');
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
