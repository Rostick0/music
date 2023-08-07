<?php

namespace App\Http\Controllers;

use App\Models\RemoveClaim;
use App\Models\Subscription;
use App\Models\User;
use Doctrine\Inflector\Rules\Substitution;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function index(Request $request)
    {
        $where_sql = [];

        if ($request->name) $where_sql[] = ['name', 'LIKE', '%' . $request->name . '%'];
        if ($request->surname) $where_sql[] = ['surname', 'LIKE', '%' . $request->surname . '%'];
        if ($request->email) $where_sql[] = ['email', 'LIKE', '%' . $request->email . '%'];
        $where_sql[] = ['is_admin', '=', '0'];

        $users = User::where($where_sql)
            ->orderByDesc('id')
            ->paginate(app('site')->count_admin ?? 20);

        return view('admin.user_list', [
            'users' => $users
        ]);
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        $subscription = Subscription::where('user_id', $id)
            ->orderByDesc('id')
            ->first();

        $remove_claims = RemoveClaim::where('user_id', $id)
            ->orderByDesc('id')
            ->paginate(10);


        return view('admin.user_edit', [
            'user' => $user,
            'subscription' => $subscription,
            'remove_claims' => $remove_claims
        ]);
    }


    public function agree()
    {
        User::find(auth()->id())->update([
            'is_agree' => 1
        ]);

        return response()->json([
            'status' => true
        ]);
    }

    public function update(Request $request)
    {
        //
    }

    public function destroy(int $id)
    {
        $user_email = User::find($id)->email;
        $user = User::destroy($id);

        return redirect(route('deleted', [
            'text' => 'Пользователь удален ' . $user_email
        ]));
    }
}
