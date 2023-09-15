<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;

class MoodController extends Controller
{
    public function index()
    {
        $mood_list = Mood::all();

        return view('admin.mood_list', [
            'mood_list' => $mood_list,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:moods,name',
        ]);

        Mood::create($validated);

        return back();
    }

    public function edit(int $id)
    {
        $mood = Mood::findOrFail($id);

        return view('admin.mood_edit', [
            'mood' => $mood,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:moods,name,' . $id,
        ]);

        Mood::find($id)->update($validated);

        return back();
    }

    public function destroy(int $id)
    {
        Mood::destroy($id);

        return redirect()->route('mood.list');
    }
}
