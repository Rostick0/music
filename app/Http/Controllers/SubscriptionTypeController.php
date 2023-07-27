<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionType;
use Illuminate\Http\Request;

class SubscriptionTypeController extends Controller
{
    public function index()
    {
        $subscription_types = SubscriptionType::paginate(app('site')->count_admin);

        return view('admin.subscription_type_list', [
            'subscription_types' => $subscription_types
        ]);
    }

    public function create()
    {
        return view('admin.subscription_type_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:65536',
            'advantages' => 'max:65536',
            'price' => ['required', 'numeric', 'regex:/^(\d+(?:\.\d{1,2})?)$/'],
        ]);

        $subscription_type = SubscriptionType::create([
            'name' => $request->name,
            'description' => $request->description,
            'advantages' => $request->advantages,
            'price' => $request->price,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return redirect()->route('subscription_type.edit', [
            'id' => $subscription_type->id
        ]);
    }

    public function edit(int $id)
    {
        $subscription_type = SubscriptionType::findOrFail($id);

        return view('admin.subscription_type_edit', [
            'subscription_type' => $subscription_type
        ]);
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:65536',
            'advantages' => 'max:65536',
            'price' => ['required', 'numeric', 'regex:/^(\d+(?:\.\d{1,2})?)$/'],
        ]);

        SubscriptionType::find($id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'advantages' => $request->advantages,
            'price' => $request->price,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        return back();
    }
}
