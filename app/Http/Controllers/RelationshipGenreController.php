<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\RelationshipGenre;
use Illuminate\Http\Request;

class RelationshipGenreController extends Controller
{
    // @param 'music|playlist' $type
    static public function createAndDeleteRelationship($request_genres, int $type_id, string $type)
    {
        $genres = $request_genres;
        $array_id = [];

        foreach ($genres as $genre) {
            $relationship = RelationshipGenre::firstOrCreate([
                'type' => $type,
                'type_id' => $type_id,
                'genres_id' => $genre->id,
            ]);

            $array_id[] = $relationship->id;
        }

        RelationshipGenre::where([
            ['type', '=', $type],
            ['type_id', '=', $type_id]
        ])->whereNotIn('id', $array_id)->delete();
    }
}
