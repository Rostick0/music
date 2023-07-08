<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Playlist;
use Illuminate\Http\Request;

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
            'seo_title' => 'max:255',
            'seo_description' => 'max:255'
        ]);

        $image = null;

        $playlist = Playlist::create([
            'title' => $request->title,
            'image' => $image,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
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
     * Display the specified resource.
     */
    public function show_edit(Playlist $playlist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Playlist $playlist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Playlist $playlist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Playlist $playlist)
    {
        //
    }
}
