<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use App\Models\RelationshipMood;
use Illuminate\Http\Request;

class Type
{
}

class RelationshipMoodController extends Controller
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

    // @param 'music|playlist' $type
    static public function createRelationship($request_moods, int $type_id, string $type)
    {
        $moods = explode(',', $request_moods);
        foreach ($moods as $mood) {
            if (!trim($mood)) continue;

            $value_mood = Mood::firstOrCreate([
                'name' => trim(mb_strtolower($mood))
            ]);

            RelationshipMood::firstOrCreate([
                'type' => $type,
                'type_id' => $type_id,
                'moods_id' => $value_mood->id,
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RelationshipMood $relationshipMood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RelationshipMood $relationshipMood)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RelationshipMood $relationshipMood)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RelationshipMood $relationshipMood)
    {
        //
    }
}
