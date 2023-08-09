<?php

namespace App\Http\Controllers;

use App\Models\SiteFaq;
use App\Models\SiteMenu;
use App\Models\SitePage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SiteMenuController extends Controller
{
    public static function view()
    {
        return SiteMenu::orderBy('order')->get();
    }

    public function index()
    {
        $menu_list = SiteMenu::orderBy('order')->get();
        $page_list = SitePage::all();

        return view('admin.menu_list', [
            'menu_list' => $menu_list,
            'page_list' => $page_list,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:32',
            'site_page_id' => 'required|' . Rule::exists('site_pages', 'id'),
            'order' => 'required|numeric'
        ]);

        SiteMenu::create($validated);

        return back();
    }

    public function edit(int $id)
    {
        $menu = SiteMenu::findOrFail($id);
        $page_list = SitePage::all();

        return view('admin.menu_edit', [
            'menu' => $menu,
            'page_list' => $page_list
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:32',
            'site_page_id' => 'required|' . Rule::exists('site_pages', 'id'),
            'order' => 'required|numeric'
        ]);

        SiteMenu::find($id)->update($validated);

        return back();
    }

    public function destroy(int $id)
    {
        SiteMenu::destroy($id);

        return back();
    }
}
