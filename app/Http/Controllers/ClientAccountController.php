<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class ClientAccountController extends Controller
{
    public function edit()
    {
        $account = Account::firstWhere([
            'user_id' => auth()->id()
        ]);

        // dd($account);

        return view('client.account', [
            'account' => $account
        ]);
    }


    public function update(Request $request)
    {
        $validated = $request->validate([
            'url' => [
                \Illuminate\Validation\Rule::unique('accounts', 'url')->ignore(auth()->id(), 'user_id')
            ]
        ]);

        $account = Account::firstWhere([
            'user_id' => auth()->id()
        ]);

        if ($account) {
            $account->update($validated);
        } else {
            $account = Account::create([
                ...$validated,
                'user_id' => auth()->id()
            ]);
        }

        return redirect()->back();
    }
}
