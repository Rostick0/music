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
        $validator = $request->validate([
            'logo' => 'required|mimes:jpeg,png,jpg,svg',
            'name' => 'required',
        ]);

        $old = json_decode(File::get(public_path('config.json')));

        $result = [
            'name' => $request->name,
            'seo_title' => $request->seo_title ?? null,
            'seo_description' => $request->seo_description ?? null,
            'email' => $request->email ?? null,
            'address' => $request->address ?? null,
            'count_admin' => $request->count_admin ?? null,
            'count_front' => $request->count_front ?? null,
            'about' => $request->about ?? null,
        ];

        $logo = ImageController::upload($request->file('logo'));
        if ($logo) {
            $result['logo'] = '/storage/upload/image/' . $logo;
        } else {
            $result['logo'] = '/storage/upload/image/' . $old?->logo ?? null;
        }

        $favicon = ImageController::upload($request->file('favicon'));
        if ($favicon) {
            $result['favicon'] = $favicon;
        } else {
            $result['favicon'] = $old?->favicon ?? null;
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
