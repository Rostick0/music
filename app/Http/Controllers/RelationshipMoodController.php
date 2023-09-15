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

    static public function createAndDeleteRelationship($request_moods, int $type_id, string $type)
    {
        $moods = $request_moods;

        if (!$moods) return;

        if (!is_array($moods)) $moods = [$moods];

        $array_id = [];

        foreach ($moods as $mood) {
            $relationship = RelationshipMood::firstOrCreate([
                'type' => $type,
                'type_id' => $type_id,
                'mood_id' => $mood,
            ]);

            $array_id[] = $relationship->id;
        }

        RelationshipMood::where([
            ['type', '=', $type],
            ['type_id', '=', $type_id]
        ])->whereNotIn('id', $array_id)->delete();
    }
}
