<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
