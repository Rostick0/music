<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\License;
use App\Models\Music;
use App\Models\Subscription;
use App\Models\SubscriptionType;
use App\Models\User;

class ClientController extends Controller
{
    public function index()
    {
        $max_price_subscription = SubscriptionType::orderByDesc('price')->first()->price;
        $subscriptions = Subscription::orderByDesc('id')
            ->where('user_id', auth()->id())
            ->paginate(app('site')->count_admin ?? 20);

        $licenses = License::orderByDesc('id')
            ->where('user_id', auth()->id())
            ->paginate(app('site')->count_admin ?? 20);

        $music = Music::all();

        $accounts = Account::where('user_id', auth()->id())->get();

        return view('client.index', compact('max_price_subscription', 'subscriptions', 'licenses', 'music', 'accounts'));
    }

    public function account()
    {
        $music = Music::all();
        $accounts = Account::where('user_id', auth()->id())->get();

        return view('client.account', compact('music', 'accounts'));
    }

    public function subscription()
    {
        $subscriptions = Subscription::orderByDesc('id')
            ->where('user_id', auth()->id())
            ->paginate(app('site')->count_admin ?? 20);

        return view('client.subscription', compact('subscriptions'));
    }

    public function settings()
    {
        $user = User::find(auth()->id());

        return view('client.settings', compact('user'));
    }

    public function support()
    {
        return view('client.support');
    }
}
