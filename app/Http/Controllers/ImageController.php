<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public static function upload($request)
    {
        if (!$request) return NULL;

        $extension = $request->getClientOriginalExtension();
        $image = time() . '.' . $extension;
        $request->storeAs('public/upload/image', $image);

        return $image;
    }

    public static function getViewImage($image, $defaultImage = '/img/music.png')
    {
        if ($image && Storage::disk('public')->exists('upload/image/' . $image)) return Storage::url('upload/image/' . $image);

        return $defaultImage;
    }

    public static function check($image) {
        return $image && Storage::disk('public')->exists('upload/image/' . $image);
    }

    public static function destroy($image_path)
    {
        if (!Storage::exists('upload/image/' . $image_path)) {
            return;
        }

        return Storage::delete('upload/image/' . $image_path);
    }
}
