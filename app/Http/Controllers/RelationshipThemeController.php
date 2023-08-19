<?php

namespace App\Http\Controllers;

use App\Models\RelationshipTheme;
use App\Models\Theme;
use Illuminate\Http\Request;

class RelationshipThemeController extends Controller
{
    static public function createAndDeleteRelationship($request_theme, int $type_id, string $type)
    {
        $themes = $request_theme;

        if (!$themes) return;

        if (!is_array($themes)) $themes = [$themes];

        $array_id = [];

        foreach ($themes as $theme) {
            $relationship = RelationshipTheme::firstOrCreate([
                'type' => $type,
                'type_id' => $type_id,
                'theme_id' => $theme
            ]);

            $array_id[] = $relationship->id;
        }

        RelationshipTheme::where([
            ['type', '=', $type],
            ['type_id', '=', $type_id]
        ])->whereNotIn('id', $array_id)->delete();
    }
}
