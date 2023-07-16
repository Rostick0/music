<?php

namespace App\Http\Controllers;

use App\Models\SitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SitePageController extends Controller
{
    private function get_path(string $name_file)
    {
        return resource_path("views/pages_db/$name_file.blade.php");
    }

    public function index(Request $request)
    {
        $where_sql = [];

        if ($request->name) $where_sql[] = ['name', 'LIKE', '%' . $request->name . '%'];
        if ($request->url) $where_sql[] = ['url', 'LIKE', '%' . $request->url . '%'];

        $pages = SitePage::where($where_sql)
            ->paginate(20);

        return view('admin.page_list', [
            'pages' => $pages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.page_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|max:255',
            'url' => 'required|max:255|unique:site_pages',
            'seo_title' => 'max:255',
            'seo_description' => 'max:255',
            'path' => 'required|max:255|unique:site_pages',
        ]);

        $path = $this->get_path($request->url);

        $file = File::put(
            $path,
            '@extends("layout.front.index")

            @section("php")
            @endsection
            
            @section("html")
            ' . $request->content . '
            @endsection'
        );

        $site_page = SitePage::create([
            'name' => $request->name,
            'url' => $request->url,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'path' => $request->path,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('page.edit', [
            'id' => $site_page->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $url = '/home', $id = null)
    {
        $path = $this->get_path($url);

        if (!File::exists($path)) return abort(404);

        return view('pages_db.' . $url, [
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $page = SitePage::findOrFail($id);

        $path = $this->get_path($page->url);

        if (!File::exists($path)) return abort(404);

        $content = File::get($path);

        return view('admin.page_edit', [
            'page' => $page,
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
            'url' => 'required|max:255|unique:site_pages,url,' . $id,
            'seo_title' => 'max:255',
            'seo_description' => 'max:255',
            'path' => 'required|max:255|unique:site_pages,path,' . $id,
        ]);

        $old_page = SitePage::find($id);
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
            'url' => $request->url,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'path' => $request->path,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $site_page = SitePage::find($id)->delete();
    }
}
