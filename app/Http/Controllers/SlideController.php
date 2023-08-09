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

        return (int) $value . 'px';
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_slide' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $image = ImageController::upload($request->file('image'), 'slide');

        $width = SlideController::setType($request->width);
        $height = SlideController::setType($request->height);

        Slide::create([
            'name' => $request->name_slide,
            'image' => $image,
            'width' => $width,
            'height' => $height,
        ]);

        return back();
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        $slide = Slide::find($id);

        ImageController::destroy($slide->image, 'slide');

        $slide->destroy($id);

        return back();
    }
}
