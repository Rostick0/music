<?php

namespace App\Http\Controllers;

use App\Models\SiteLinks;
use App\Models\SitePage;
use Illuminate\Http\Request;

class SitePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $url)
    {
        $link = SiteLinks::where('url', $url)->firstOrFail();
        $page = SitePage::find($link->site_pages_id)->firstOrFail();

        return view('page', [
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
