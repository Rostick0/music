<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public static function upload($request, $type = 'image')
    {
        if (!$request) return NULL;

        $extension = $request->getClientOriginalExtension();
        $image = time() . '.' . $extension;
        $request->storeAs('public/upload/' . $type, $image);

        return $image;
    }

    public static function getViewImage($image, $type = 'image', $defaultImage = '/img/music.png')
    {
        if ($image && Storage::disk('public')->exists("upload/$type/" . $image)) return Storage::url("upload/$type/" . $image);

        return $defaultImage;
    }

    public static function check($image, $type = 'image',)
    {
        return $image && Storage::disk('public')->exists("upload/$type/" . $image);
    }

    public static function destroy($image_path, $type = 'image')
    {
        if (!Storage::exists("upload/$type/" . $image_path)) {
            return;
        }

        return Storage::delete("upload/$type/" . $image_path);
    }
}
