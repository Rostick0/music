<?php

namespace App\Http\Controllers;

use App\Models\Instrument;
use Illuminate\Http\Request;

class InstrumentController extends Controller
{
    public function index()
    {
        $instrument_list = Instrument::all();

        return view('admin.instrument_list', [
            'instrument_list' => $instrument_list,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:instruments,name',
        ]);

        Instrument::create($validated);

        return back();
    }

    public function edit(int $id)
    {
        $instrument = Instrument::findOrFail($id);

        return view('admin.instrument_edit', [
            'instrument' => $instrument,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:instruments,name,' . $id,
        ]);

        Instrument::find($id)->update($validated);

        return back();
    }

    public function destroy(int $id)
    {
        Instrument::destroy($id);

        return redirect()->route('instrument.list');
    }
}
