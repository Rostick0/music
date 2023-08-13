<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genre_list = Genre::all();

        return view('admin.genre_list', [
            'genre_list' => $genre_list,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:genres,name',
        ]);

        Genre::create($validated);

        return back();
    }

    public function edit(int $id)
    {
        $genre = Genre::findOrFail($id);

        return view('admin.genre_edit', [
            'genre' => $genre,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:genres,name,' . $id,
        ]);

        Genre::find($id)->update($validated);

        return back();
    }

    public function destroy(int $id)
    {
        Genre::destroy($id);

        return redirect()->route('genre.list');
    }
}
