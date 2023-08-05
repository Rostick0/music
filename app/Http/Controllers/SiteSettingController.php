<?php

namespace App\Http\Controllers;

use App\Models\SiteFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $faq_list = SiteFaq::all();

        return view('admin.settings', [
            'faq_list' => $faq_list
        ]);
    }

    public function update(Request $request)
    {
        $validator = $request->validate([
            'logo' => 'required',
            'name' => 'required',
        ]);

        $result = [
            'logo' => $request->logo,
            'favicon' => $request->favicon,
            'name' => $request->name,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'email' => $request->email,
            'address' => $request->address,
            'count_admin' => $request->count_admin,
            'count_front' => $request->count_front,
            'about' => $request->about,
        ];

        File::put(public_path('config.json'), json_encode($result));

        return back();
    }

    // public function update_banner(Request $request)
    // {
    //     $request->validate([
    //         'heigth' => 'numeric'
    //     ]);

    //     $request = [
    //         'title' => $request->title,
    //         'subtitle' => $request->subtitle,
    //         'height' => $request->heigth + 'px',
    //     ];
    // }
}
