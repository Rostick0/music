<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteBannerController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'text' => 'required|string',
            'button_text' => 'required',
            'button_link' => 'required'
        ]);

        $old = app('banner');
        $icon = $old?->icon;
        dd($old);  

        $update_date = [...$validated, 'icon' => $icon];

        if ($request->hasFile('icon')) $update_date['icon'] = '/storage/upload/image/' . ImageController::upload($request->file('icon'));

        File::put(public_path('banner.json'), json_encode($update_date));

        return back();
    }
}
