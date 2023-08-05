<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    public static function setType($value)
    {
        if (mb_substr($value, -1) == '%') {
            return (int) $value + '%';
        }

        return (int) $value + 'px';
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $image = ImageController::upload($request->file('image'));

        $width = SlideController::setType($request->width);
        $height = SlideController::setType($request->height);

        Slide::create([
            'image' => $image,
            'width' => $width,
            'height' => $height,
        ]);

        return back();
    }

    public function update(Request $request, Slide $slide)
    {
        //
    }

    public function destroy(int $id)
    {
        Slide::destroy($id);

        return back();
    }
}
