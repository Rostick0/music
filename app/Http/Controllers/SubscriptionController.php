<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subscription_types = SubscriptionType::all();

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

        return view('admin.subscription_list', [
            'subscriptions' => $subscriptions,
            'subscription_types' => $subscription_types,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
