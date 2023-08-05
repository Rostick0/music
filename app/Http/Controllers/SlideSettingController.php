<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SlideSettingController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'bg_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'count-slide-1440' => 'required|numeric',
            'count-slide-768' => 'required|numeric',
            'count-slide-400' => 'required|numeric',
            'count-slide-min' => 'required|numeric'
        ]);

        File::put(public_path('slider.json'), json_encode($validated));
    }
}
