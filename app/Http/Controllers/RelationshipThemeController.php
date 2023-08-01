<?php

namespace App\Http\Controllers;

use App\Models\RelationshipTheme;
use App\Models\Theme;
use Illuminate\Http\Request;

class RelationshipThemeController extends Controller
{
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
                'theme_id' => $value_theme->id
            ]);
        }
    }

    static public function createAndDeleteRelationship($request_theme, int $type_id, string $type)
    {
        $themes = explode(',', $request_theme);
        $array_id = [];

        foreach ($themes as $theme) {
            if (!trim($theme)) continue;

            $value_theme = Theme::firstOrCreate([
                'name' => trim(mb_strtolower($theme))
            ]);

            $relationship = RelationshipTheme::firstOrCreate([
                'type' => $type,
                'type_id' => $type_id,
                'theme_id' => $value_theme->id
            ]);

            $array_id[] = $relationship->id;
        }

        RelationshipTheme::where([
            ['type', '=', $type],
            ['type_id', '=', $type_id]
        ])->whereNotIn('id', $array_id)->delete();
    }
}
