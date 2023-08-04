<?php

namespace App\Http\Controllers;

use App\Models\RemoveClaim;
use Illuminate\Http\Request;

class RemoveClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('client.remove_claim');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $music_id)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'link' => 'required|max:255',
            'music_id' => 'required'
        ]);

        $user_id = auth()->id();

        $remove_claim = RemoveClaim::create([
            'link' => $request->link,
            'music_id' => $request->music_id,
            'user_id' => $user_id
        ]);

        return $remove_claim;
    }

    /**
     * Display the specified resource.
     */
    public function show(RemoveClaim $removeClaim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RemoveClaim $removeClaim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = $request->validate([
            'id' => 'required',
            'status' => 'required|max:255',
        ]);

        RemoveClaim::find($request->id)->update([
            'status' => $request->status
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RemoveClaim $removeClaim)
    {
        //
    }
}
