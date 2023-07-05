<?php

namespace App\Http\Controllers;

use App\Models\SiteLinks;
use App\Models\SitePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SitePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $url, int $id = null)
    {
        // $link = SiteLinks::where('url', $url)->firstOrFail();
        // $page = SitePage::find($link->site_pages_id)->firstOrFail();

        $path = resource_path("views/pages_db/$url.blade.php");

        // dd($path);

        // File::put(resource_path("views/pages_db/dd.blade.php"), 'dd');
        // File::delete(resource_path("views/pages_db/dd.blade.php"));

        if (!File::exists($path)) return abort(404);;

        $page = File::get($path);

        return view('pages_db.test', [
            'page' => $page
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(SitePage $sitePage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SitePage $sitePage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SitePage $sitePage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SitePage $sitePage)
    {
        //
    }
}
