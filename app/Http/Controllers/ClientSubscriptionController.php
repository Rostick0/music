<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class ClientSubscriptionController extends Controller
{
    public function index(Request $request) {
        $subscription_types = Subscription::all();

        $where_sql = [];
        if ($request->email)  $where_sql[] = ['users.email', 'LIKE', '%' . $request->email . '%'];

        $subscriptions = Subscription::select(
            'subscriptions.*',
            'subscription_types.name as subscription_name',
            // 'subscription_types.price as subscription_price',
            'users.email as user_email'
        )
            ->join('subscription_types', 'subscription_types.id', '=', 'subscriptions.subscription_types_id')
            ->join('users', 'users.id', '=', 'subscriptions.users_id')
            ->orderByDesc('subscriptions.id')
            ->where($where_sql);

        if ($request->subscription_types) {
            $subscriptions->whereIn('subscriptions.subscription_types_id', $request->subscription_types);
        }

        $subscriptions = $subscriptions->paginate(app('site')->count_admin ?? 20);

        return view('client.subscription_list');
    }
}
