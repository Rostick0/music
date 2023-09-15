<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\RelationshipInstrument;
use Illuminate\Http\Request;

class RelationshipInstrumentController extends Controller
{
    // @param 'music|playlist' $type

    static public function createAndDeleteRelationship($request_instruments, int $type_id, string $type)
    {
        $instruments = $request_instruments;

        if (!$instruments) return;

        if (!is_array($instruments)) $instruments = [$instruments];

        $array_id = [];

        foreach ($instruments as $instrument) {
            $relationship = RelationshipInstrument::firstOrCreate([
                'type' => $type,
                'type_id' => $type_id,
                'instrument_id' => $instrument,
            ]);

            $array_id[] = $relationship->id;
        }

        RelationshipInstrument::where([
            ['type', '=', $type],
            ['type_id', '=', $type_id]
        ])->whereNotIn('id', $array_id)->delete();
    }
}
