<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ClientAccountController;
use App\Http\Controllers\ClientLicenseController;
use App\Http\Controllers\ClientMusicController;
use App\Http\Controllers\ClientRemoveClaimController;
use App\Http\Controllers\ClientStatisticController;
use App\Http\Controllers\ClientStoryController;
use App\Http\Controllers\ClientSubscriptionController;
use App\Http\Controllers\ClientUserController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\DeletedController;
use App\Http\Controllers\EmailVertificationController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\LicnseController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MoodController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\MusicKitController;
use App\Http\Controllers\MusicPartController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RelationshipPlaylistController;
use App\Http\Controllers\RemoveClaimController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SiteBannerController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SiteFaqController;
use App\Http\Controllers\SiteMenuController;
use App\Http\Controllers\SitePageController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\SliderSettingController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionTypeController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Routing\RouteGroup;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ,'middleware' => 'admin'
Route::group(['prefix' => 'admin'], function ($router) {
    Route::group(['prefix' => 'music'], function ($router) {
        Route::get('list', [MusicController::class, 'index'])->name('music.list');
        Route::get('create', [MusicController::class, 'create'])->name('music.create');
        Route::post('create', [MusicController::class, 'store']);
        Route::get('{id}', [MusicController::class, 'edit'])->name('music.edit');
        Route::post('{id}', [MusicController::class, 'update']);
        Route::post('delete/{id}', [MusicController::class, 'destroy'])->name('music.delete');
    });

    Route::group(['prefix' => 'part'], function ($router) {
        Route::post('create', [MusicPartController::class, 'store'])->name('part.create');
        Route::get('edit/{id}', [MusicPartController::class, 'edit'])->name('part.edit');
        Route::post('edit/{id}', [MusicPartController::class, 'update']);
        Route::post('delete/{id}', [MusicPartController::class, 'destroy'])->name('part.delete');
    });

    Route::group(['prefix' => 'music_kit'], function ($router) {
        Route::get('list', [MusicKitController::class, 'index'])->name('music_kit.list');
        Route::get('create', [MusicKitController::class, 'create'])->name('music_kit.create');
        Route::post('create', [MusicKitController::class, 'store']);
        Route::get('{id}', [MusicKitController::class, 'edit'])->name('music_kit.edit');
        Route::post('{id}', [MusicKitController::class, 'update']);
        Route::post('delete/{id}', [MusicKitController::class, 'destroy'])->name('music_kit.delete');
    });


    Route::group(['prefix' => 'playlist'], function ($router) {
        Route::get('list', [PlaylistController::class, 'index'])->name('playlist');
        Route::get('create', [PlaylistController::class, 'create'])->name('playlist.create');
        Route::post('create', [PlaylistController::class, 'store']);
        Route::get('{id}', [PlaylistController::class, 'edit'])->name('playlist.edit');
        Route::post('{id}', [PlaylistController::class, 'update']);
        Route::post('delete/{id}', [PlaylistController::class, 'destroy'])->name('playlist.delete');
        Route::get('{playlist_id}/music/list', [RelationshipPlaylistController::class, 'music_list'])->name('playlist.music.list');
        Route::post('{playlist_id}/music/list/{music_id}', [RelationshipPlaylistController::class, 'music_add'])->name('playlist.music.add');
        Route::post('music/delete/{id}', [RelationshipPlaylistController::class, 'music_remove'])->name('playlist.music.delete');
    });

    Route::get('statistic', [StatisticController::class, 'index'])->name('statistic');
    Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions');

    Route::group(['prefix' => 'subscription_type'], function ($router) {
        Route::get('list', [SubscriptionTypeController::class, 'index'])->name('subscription_type.list');
        Route::get('create', [SubscriptionTypeController::class, 'create'])->name('subscription_type.create');
        Route::post('create', [SubscriptionTypeController::class, 'store']);
        Route::get('{id}', [SubscriptionTypeController::class, 'edit'])->name('subscription_type.edit');
        Route::post('{id}', [SubscriptionTypeController::class, 'update']);
        Route::post('delete/{id}', [SubscriptionTypeController::class, 'destroy'])->name('subscription_type.delete');
    });

    Route::group(['prefix' => 'users'], function ($router) {
        Route::get('/', [UserController::class, 'index'])->name('user.list');
        Route::get('{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('{id}', [UserController::class, 'update']);
        Route::post('delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
    });

    Route::group(['prefix' => 'remove_claim'], function ($router) {
        Route::get('{id}', [RemoveClaimController::class, 'edit'])->name('remove_claim.edit');
        Route::post('{id}', [RemoveClaimController::class, 'update']);
    });

    Route::get('settings', [SiteSettingController::class, 'edit'])->name('settings');
    Route::post('settings', [SiteSettingController::class, 'update']);

    Route::group(['prefix' => 'faq'], function ($router) {
        Route::post('create', [SiteFaqController::class, 'store'])->name('faq.create');
        Route::get('edit/{id}', [SiteFaqController::class, 'edit'])->name('faq.edit');
        Route::post('edit/{id}', [SiteFaqController::class, 'update']);
        Route::post('delete/{id}', [SiteFaqController::class, 'destroy'])->name('faq.delete');
    });

    Route::group(['prefix' => 'slider'], function ($router) {
        Route::post('setting', [SliderSettingController::class, 'update'])->name('slider.setting');
        Route::post('create', [SlideController::class, 'store'])->name('slide.create');
        Route::post('delete/{id}', [SlideController::class, 'destroy'])->name('slide.delete');
    });

    Route::group(['prefix' => 'pages'], function ($router) {
        Route::get('list', [SitePageController::class, 'index'])->name('page.list');
        Route::get('create', [SitePageController::class, 'create'])->name('page.create');
        Route::post('create', [SitePageController::class, 'store']);
        Route::get('{id}', [SitePageController::class, 'edit'])->name('site_page.edit');
        Route::post('{id}', [SitePageController::class, 'update']);
        Route::post('delete/{id}', [SitePageController::class, 'destroy'])->name('site_page.delete');
    });

    Route::post('banner', [SiteBannerController::class, 'update'])->name('banner.edit');
    // Route::group(['prefix' => 'components'], function ($router) {
    //     Route::get('list', [ComponentController::class, 'index'])->name('component.list');
    //     Route::get('create', [ComponentController::class, 'create'])->name('component.create');
    //     Route::post('create', [ComponentController::class, 'store']);
    //     Route::get('{id}', [ComponentController::class, 'edit'])->name('component.edit');
    //     Route::post('{id}', [ComponentController::class, 'update']);
    //     Route::post('delete/{id}', [ComponentController::class, 'destroy'])->name('component.delete');
    // });

    Route::get('notices', [NoticeController::class, 'index'])->name('notices');

    Route::get('/deleted', [DeletedController::class, 'show'])->name('deleted');
    Route::get('/delete_confirm', [DeletedController::class, 'confirm'])->name('delete_confirm');

    Route::get('profile_edit', [AdminUserController::class, 'edit'])->name('admin.profile.edit');
    Route::post('profile_edit', [AdminUserController::class, 'update']);
    Route::post('profile_password', [AdminUserController::class, 'password_update'])->name('admin.profile_password');

    Route::group(['prefix' => 'menu'], function ($router) {
        Route::get('list', [SiteMenuController::class, 'index'])->name('menu.list');
        Route::post('list', [SiteMenuController::class, 'store']);
        Route::get('edit/{id}', [SiteMenuController::class, 'edit'])->name('menu.edit');
        Route::post('edit/{id}', [SiteMenuController::class, 'update']);
        Route::post('delete/{id}', [SiteMenuController::class, 'destroy'])->name('menu.delete');
    });

    Route::group(['prefix' => 'genre'], function ($router) {
        Route::get('list', [GenreController::class, 'index'])->name('genre.list');
        Route::post('list', [GenreController::class, 'store']);
        Route::get('edit/{id}', [GenreController::class, 'edit'])->name('genre.edit');
        Route::post('edit/{id}', [GenreController::class, 'update']);
        Route::post('delete/{id}', [GenreController::class, 'destroy'])->name('genre.delete');
    });

    Route::group(['prefix' => 'mood'], function ($router) {
        Route::get('list', [MoodController::class, 'index'])->name('mood.list');
        Route::post('list', [MoodController::class, 'store']);
        Route::get('edit/{id}', [MoodController::class, 'edit'])->name('mood.edit');
        Route::post('edit/{id}', [MoodController::class, 'update']);
        Route::post('delete/{id}', [MoodController::class, 'destroy'])->name('mood.delete');
    });

    Route::group(['prefix' => 'instrument'], function ($router) {
        Route::get('list', [InstrumentController::class, 'index'])->name('instrument.list');
        Route::post('list', [InstrumentController::class, 'store']);
        Route::get('edit/{id}', [InstrumentController::class, 'edit'])->name('instrument.edit');
        Route::post('edit/{id}', [InstrumentController::class, 'update']);
        Route::post('delete/{id}', [InstrumentController::class, 'destroy'])->name('instrument.delete');
    });

    Route::group(['prefix' => 'theme'], function ($router) {
        Route::get('list', [ThemeController::class, 'index'])->name('theme.list');
        Route::post('list', [ThemeController::class, 'store']);
        Route::get('edit/{id}', [ThemeController::class, 'edit'])->name('theme.edit');
        Route::post('edit/{id}', [ThemeController::class, 'update']);
        Route::post('delete/{id}', [ThemeController::class, 'destroy'])->name('theme.delete');
    });

    Route::get('account/list', [AccountController::class, 'index'])->name('account.list');

    Route::get('story/list', [StoryController::class, 'index'])->name('story.list');

    Route::group(['prefix' => 'license'], function () {
        Route::get('/list', [LicnseController::class, 'index'])->name('license.list');
    });

    Route::group(['prefix' => 'pdf'], function () {
        Route::get('/edit', [PDFController::class, 'edit'])->name('pdf.edit');
        Route::post('/edit', [PDFController::class, 'update']);
        Route::get('/preview/{id}', [PDFController::class, 'preview'])->name('pdf.preview');
        Route::get('/generate/{id}', [PDFController::class, 'generate'])->name('pdf.generate');
    });
});

Route::group(['prefix' => 'client', 'middleware' => 'auth'], function ($router) {
    Route::get('subscriptions', [ClientSubscriptionController::class, 'index'])->name('client.subscriptions');

    Route::group(['prefix' => 'remove_claim'], function ($router) {
        Route::get('list', [ClientRemoveClaimController::class, 'index'])->name('client.remove_claim.list');
        Route::get('create', [ClientRemoveClaimController::class, 'create'])->name('client.remove_claim.create');
        Route::post('create', [ClientRemoveClaimController::class, 'store']);
    });

    Route::group(['prefix' => 'account'], function ($router) {
        Route::get('list', [ClientAccountController::class, 'index'])->name('client.account.list');
        Route::get('create', [ClientAccountController::class, 'create'])->name('client.account.create');
        Route::post('create', [ClientAccountController::class, 'store']);
        Route::get('edit/{id}', [ClientAccountController::class, 'edit'])->name('client.account.edit');
        Route::post('edit/{id}', [ClientAccountController::class, 'update']);
        Route::post('delete/{id}', [ClientAccountController::class, 'destroy'])->name('client.account.delete');
    });

    Route::get('story/list', [ClientStoryController::class, 'index'])->name('client.story.list');

    Route::get('music/list', [ClientMusicController::class, 'index'])->name('client.music.list');

    Route::get('license/list', [ClientLicenseController::class, 'index'])->name('client.license.list');
    Route::get('license/{id}', [ClientLicenseController::class, 'show'])->name('client.license.show');

    Route::get('profile_edit', [ClientUserController::class, 'edit'])->name('client.profile_edit');
    Route::post('profile_edit', [ClientUserController::class, 'update']);
    Route::post('profile_password', [ClientUserController::class, 'password_update'])->name('client.profile_password');

    Route::group(['prefix' => 'pdf'], function () {
    });
});

Route::group(['middleware' => 'guest'], function ($router) {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);

    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/reset_password', [ResetPasswordController::class, 'show'])->name('password.email');
    Route::post('/reset_password', [ResetPasswordController::class, 'store']);

    Route::get('/reset_edit/{token}', [ResetPasswordController::class, 'edit'])->name('password.reset');
    Route::post('/reset_edit/{token}', [ResetPasswordController::class, 'update']);
});

Route::get('logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/email/verify', [EmailVertificationController::class, 'show'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', [EmailVertificationController::class, 'notification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::group(['prefix' => 'favorite'], function ($router) {
    Route::post('create', [FavoriteController::class, 'create'])->name('favorite.create');
    Route::post('delete', [FavoriteController::class, 'destroy'])->name('favorite.delete');
});

Route::get('/', [SitePageController::class, 'show']);
Route::get('{url}', [SitePageController::class, 'show']);
Route::get('{url}/{id}', [SitePageController::class, 'show']);

Route::post('/contacts', [FeedbackController::class, 'store']);
