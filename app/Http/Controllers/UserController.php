<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        $users = User::where($where_sql)
            ->orderByDesc('id')
            ->paginate(20);

        return view('admin.user_list', [
            'users' => $users
        ]);
    }

    public function show()
    {
    }

    public function edit()
    {
        return view('admin.user_edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }
}
