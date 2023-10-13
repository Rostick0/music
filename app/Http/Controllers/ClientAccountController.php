<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class ClientAccountController extends Controller
{
    public function index(Request $request)
    {
        $accounts = Account::where('user_id', auth()->id())->orderByDesc('id');

        if ($request->title) $accounts->where('title', 'like', '%' . $request->title . '%');

        $accounts = $accounts->paginate(app('site')->count_admin ?? 20);

        return view('client.account_list', [
            'accounts' => $accounts
        ]);
    }

    public function create()
    {
        return view('client.account_create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'url' => 'required',
        ]);

        $account = Account::create([
            ...$validated,
            'user_id' => auth()->id()
        ]);

        return redirect()->route('client.account.edit', [
            'id' => $account->id
        ]);
    }

    public function edit(int $id)
    {
        $account = Account::where([
            'id' => $id,
            'user_id' => auth()->id()
        ])->firstOrFail();

        return view('client.account_edit', [
            'account' => $account
        ]);
    }


    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'url' => 'required'
        ]);

        $account = Account::where([
            'id' => $id,
            'user_id' => auth()->id()
        ])->firstOrFail();

        $account->update($validated);

        return redirect()->back();
    }

    public function destroy($id)
    {
        Account::where([
            'id' => $id,
            'user_id' => auth()->id()
        ])->delete();

        return redirect()->route('client.account.list');
    }
}
