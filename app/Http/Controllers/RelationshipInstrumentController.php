<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use App\Models\RelationshipInstrument;
use Illuminate\Http\Request;

class RelationshipInstrumentController extends Controller
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
    static public function createRelationship($request_instruments, int $type_id, string $type)
    {
        $instruments = explode(',', $request_instruments);
        foreach ($instruments as $instrument) {
            if (!trim($instrument)) continue;

            $value_instrument = Instrument::firstOrCreate([
                'name' => trim(mb_strtolower($instrument))
            ]);

            RelationshipInstrument::firstOrCreate([
                'type' => $type,
                'type_id' => $type_id,
                'instruments_id' => $value_instrument->id,
            ]);
        }
    }

    static public function createAndDeleteRelationship($request_instruments, int $type_id, string $type)
    {
        $instruments = explode(',', $request_instruments);
        $array_id = [];

        foreach ($instruments as $instrument) {
            if (!trim($instrument)) continue;

            $value_instrument = Instrument::firstOrCreate([
                'name' => trim(mb_strtolower($instrument))
            ]);

            $relationship = RelationshipInstrument::firstOrCreate([
                'type' => $type,
                'type_id' => $type_id,
                'instruments_id' => $value_instrument->id,
            ]);

            $array_id[] = $relationship->id;
        }

        RelationshipInstrument::where([
            ['type', '=', $type],
            ['type_id', '=', $type_id]
        ])->whereNotIn('id', $array_id)->delete();
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
    public function show(RelationshipInstrument $relationshipInstrument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RelationshipInstrument $relationshipInstrument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RelationshipInstrument $relationshipInstrument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RelationshipInstrument $relationshipInstrument)
    {
        //
    }
}
