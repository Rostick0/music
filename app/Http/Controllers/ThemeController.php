<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $theme_list = Theme::all();

        return view('admin.theme_list', [
            'theme_list' => $theme_list,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:genres,name',
        ]);

        Theme::create($validated);

        return back();
    }

    public function edit(int $id)
    {
        $theme = Theme::findOrFail($id);

        return view('admin.theme_edit', [
            'theme' => $theme,
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:themes,name,' . $id,
        ]);

        Theme::find($id)->update($validated);

        return back();
    }

    public function destroy(int $id)
    {
        Theme::destroy($id);

        return redirect()->route('theme.list');
    }
}
