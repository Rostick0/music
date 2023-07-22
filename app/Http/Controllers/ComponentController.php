<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ComponentController extends Controller
{
    private function get_path(string $name_file)
    {
        return resource_path("views/components/$name_file.blade.php");
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $where_sql = [];

        if ($request->name) $where_sql[] = ['name', 'LIKE', '%' . $request->name . '%'];

        $components = Component::where($where_sql)
            ->paginate(20);

        return view('admin.component_list', [
            'components' => $components
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.component_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'path' => 'required|max:255|unique:components',
        ]);

        $path = $this->get_path($request->path);

        $file = File::put($path, $request->content);

        $component = Component::create([
            'name' => $request->name,
            'path' => $request->path,
        ]);

        return redirect()->route('component.edit', [
            'id' => $component->id
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $component = Component::findOrFail($id);

        $path = $this->get_path($component->path);

        if (!File::exists($path)) return abort(404);

        $content = File::get($path);

        return view('admin.component_edit', [
            'component' => $component,
            'content' => $content
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'path' => 'required|max:255|unique:components,path,' . $id,
        ]);

        $old_page = Component::find($id);
        $path_old = $this->get_path($old_page->path);
        $path_new = $this->get_path($request->path);

        if ($old_page->path != $request->path) {
            File::delete($path_old);
            $file = File::put($path_new, $request->content);
        } else {
            $file = File::put($path_old, $request->content);
        }

        $old_page->update([
            'name' => $request->name,
            'path' => $request->path,
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $component = Component::find($id)->delete();

        return redirect(route('deleted', [
            'text' => 'Компонент удален ' . $component->name
        ]));
    }
}
