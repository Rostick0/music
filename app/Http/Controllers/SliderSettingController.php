<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderSettingController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'bg_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'count_slide_1440' => 'required|numeric',
            'count_slide_768' => 'required|numeric',
            'count_slide_400' => 'required|numeric',
            'count_slide_min' => 'required|numeric'
        ]);

        File::put(public_path('slider.json'), json_encode($validated));
    }

    public static function get()
    {
        if (!File::exists(public_path('slider.json'))) return [];

        return json_decode(File::get(public_path('slider.json')));
    }
}
