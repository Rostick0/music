<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('admin.settings');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = $request->validate([
            'logo' => 'required',
            'name' => 'required',
        ]);

        $result = [
            "logo" => $request->logo,
            "favicon" => $request->favicon,
            "name" => $request->name,
            "seo_title" => $request->seo_title,
            "seo_description" => $request->seo_description,
            "email" => $request->email,
            "address" => $request->address
        ];

        File::put(public_path('config.json'), json_encode($result));

        return back();
    }
}
