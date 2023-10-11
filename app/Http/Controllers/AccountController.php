<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $accounts = Account::orderByDesc('id');

        if ($request->email) $accounts->whereHas('user', function (Builder $query) use ($request) {
            $query->where('email', 'like', '%' . $request->email . '%');
        });

        $accounts = $accounts->paginate(app('site')->count_admin ?? 20);

        return view('admin.account_list', [
            'accounts' => $accounts
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        //
    }

    public function edit(int $id)
    {
        //
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(int $id)
    {
        //
    }
}
