<?php

namespace App\Providers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        App::singleton('site', function () {
            return json_decode(File::get(public_path('config.json')));
        });
        View::share('site', app('site'));

        App::singleton('banner', function () {
            return json_decode(File::get(public_path('banner.json')));
        });
        View::share('banner', app('banner'));

        App::singleton('has_subscription', function () {
            $has_subscription = false;

            if (auth()->check()) {
                $has_subscription = Subscription::where([
                    ['date_end', '>=', Carbon::now()],
                    ['user_id', '=', auth()->id()]
                ])->count() ? true : false;
            }

            return $has_subscription;
        });

        View::share('favorite', function ($favorite_id, $music_item_id, $type) {
            if ($favorite_id) return true;

            $local_data = json_decode(Cookie::get('favorite'));

            if (!is_array($local_data)) return false;

            $object = (object) ['type_id' => $music_item_id, 'type' => $type];

            return in_array($object, $local_data);
        });

        View::share('htmlSection', function ($text) {
            $startString = "@section('html')";
            $endString = '@endsection';
            $startPosition = strpos($text, $startString);
            if ($startPosition !== false) {
                $startPosition += strlen($startString);
                $endPosition = strpos($text, $endString, $startPosition);
                if ($endPosition !== false) {
                    $result = substr($text, $startPosition, $endPosition - $startPosition);
                    echo $result;
                }
            }
        });
    }
}
