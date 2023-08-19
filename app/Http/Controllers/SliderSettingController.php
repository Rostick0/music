<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderSettingController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'slider_title' => 'required',
            'slider_description' => 'required',
            'bg_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'button_first_text' => 'required',
            'button_first_link' => 'required',
            'button_second_text' => 'required',
            'button_second_link' => 'required',
            'count_slide_1440' => 'required|numeric',
            'count_slide_768' => 'required|numeric',
            'count_slide_400' => 'required|numeric',
            'count_slide_min' => 'required|numeric'
        ]);

        $image = ImageController::upload($request->file('bg_image'));

        $data_update = [
            'slider_title' => $request->slider_title,
            'slider_description' => $request->slider_description,
            'button_first_text' => $request->button_first_text,
            'button_first_link' => $request->button_first_link,
            'button_second_text' => $request->button_second_text,
            'button_second_link' => $request->button_second_link,
            'count_slide_1440' => $request->count_slide_1440,
            'count_slide_768' => $request->count_slide_768,
            'count_slide_400' => $request->count_slide_400,
            'count_slide_min' => $request->count_slide_min
        ];

        if ($image) $data_update['bg_image'] = $image;

        File::put(public_path('slider.json'), json_encode($data_update));

        return back();
    }

    public static function get()
    {
        if (!File::exists(public_path('slider.json'))) return [];

        return json_decode(File::get(public_path('slider.json')));
    }
}
