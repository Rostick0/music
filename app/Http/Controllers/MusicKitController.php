<?php

namespace App\Http\Controllers;

use App\Models\MusicKit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MusicKitController extends Controller
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
            'name' => 'required|max:255',
            'link' => 'required|max:255',
            'music_id' => 'required|' . Rule::exists('music', 'id'),
        ]);

        return MusicKit::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(MusicKit $musicKit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MusicKit $musicKit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $music_id)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'link' => 'required|max:255',
        ]);

        MusicKit::where('music_id', $music_id)->update($request->all());

        return MusicKit::where('music_id', $music_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MusicKit $musicKit)
    {
        //
    }
}
