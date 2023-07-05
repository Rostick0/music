<?php

namespace App\Http\Controllers;

use App\Models\RelationshipTheme;
use App\Models\Theme;
use Illuminate\Http\Request;

class RelationshipThemeController extends Controller
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
    static public function createRelationship($request_theme, int $type_id, string $type)
    {
        $themes = explode(',', $request_theme);
        foreach ($themes as $theme) {
            if (!trim($theme)) continue;

            $value_theme = Theme::firstOrCreate([
                'name' => trim(mb_strtolower($theme))
            ]);

            RelationshipTheme::firstOrCreate([
                'type' => $type,
                'type_id' => $type_id,
                'themes_id' => $value_theme->id
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
    public function show(RelationshipTheme $relationshipTheme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RelationshipTheme $relationshipTheme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RelationshipTheme $relationshipTheme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RelationshipTheme $relationshipTheme)
    {
        //
    }
}
