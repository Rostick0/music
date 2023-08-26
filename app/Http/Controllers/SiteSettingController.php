<?php

namespace App\Http\Controllers;

use App\Models\SiteFaq;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $faq_list = SiteFaq::all();
        $slider_config = SliderSettingController::get();
        $slide_list = Slide::all();

        return view('admin.settings', [
            'faq_list' => $faq_list,
            'slider_config' => $slider_config,
            'slide_list' => $slide_list,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'mimes:jpeg,png,jpg,svg',
            'name' => 'required',
            'count_admin' => 'required',
            'count_front' => 'required'
        ]);

        $old = json_decode(File::get(public_path('config.json')));

        $result = [
            'name' => $request->name,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'email' => $request->email,
            'address' => $request->address,
            'count_admin' => (int) $request->count_admin,
            'count_front' => (int) $request->count_front,
            'about' => $request->about,
        ];

        $result['logo'] = $old?->logo;
        if ($request->file('logo')) {
            $new_logo = ImageController::upload($request->file('logo'));
            $result['logo'] = '/storage/upload/image/' . $new_logo;
        }

        $result['favicon'] = $old?->favicon;

        if ($request->file('favicon')) {
            $new_favicon = ImageController::upload($request->file('favicon'));
            $result['favicon'] = '/storage/upload/image/' . $new_favicon;
        }

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
