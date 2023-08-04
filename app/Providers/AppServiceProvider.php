<?php

namespace App\Providers;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
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
    }
}
