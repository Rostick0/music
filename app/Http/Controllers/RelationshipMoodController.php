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
    // @param 'music|playlist' $type

    static public function get(int $type_id, string $type)
    {
        $moods = RelationshipMood::select('moods.name')->join('moods', 'relationship_moods.moods_id', '=', 'moods.id')
            ->where([
                ['relationship_moods.type_id', '=', $type_id],
                ['relationship_moods.type', '=', $type]
            ])->get();
        $moods = array_map(function ($item) {
            return $item['name'];
        },  [...$moods]);

        return $moods;
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

    static public function createAndDeleteRelationship($request_moods, int $type_id, string $type)
    {
        $moods = explode(',', $request_moods);
        $array_id = [];

        foreach ($moods as $mood) {
            if (!trim($mood)) continue;

            $value_mood = Mood::firstOrCreate([
                'name' => trim(mb_strtolower($mood))
            ]);

            $relationship = RelationshipMood::firstOrCreate([
                'type' => $type,
                'type_id' => $type_id,
                'moods_id' => $value_mood->id,
            ]);

            $array_id[] = $relationship->id;
        }

        RelationshipMood::where([
            ['type', '=', $type],
            ['type_id', '=', $type_id]
        ])->whereNotIn('id', $array_id)->delete();
    }
}
