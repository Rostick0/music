<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;

class LicnseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $where_sql = [];

        $licenses = License::query();

        if ($request->email) {
            $licenses->whereHas('user', function ($query) use ($request) {
                $query->where('email', 'LIKE', '%' . $request->email . '%');
            });
        }
        if ($request->code) $where_sql[] = ['code', 'LIKE', '%' . $request->code . '%'];
        if ($request->licensesable_id) $where_sql[] = ['licensesable_id', '=', $request->licensesable_id];


        $licenses = $licenses->where($where_sql)
            ->orderByDesc('id')
            ->paginate(app('site')->count_admin ?? 20);

        return view('admin.license_list', compact('licenses'));
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
    public function show(int $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(License $license)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, License $license)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(License $license)
    {
        //
    }
}
