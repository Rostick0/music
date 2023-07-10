<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notices = Notice::select(
            'notices.*',
            'remove_claims.link as remove_claim_link',
            'remove_claims.status as remove_claim_status',
            'users.name as user_name',
            'users.email as user_email',
            'music.id as music_id',
            'music.title as music_title'
        )
            ->join('remove_claims', function (JoinClause $join) {
                $join->on('notices.type_id', '=', 'remove_claims.id')
                    ->where('notices.type', '=', 'remove_claims')
                    ->join('users', 'users.id', '=', 'remove_claims.users_id')
                    ->join('music', 'music.id', '=', 'remove_claims.music_id');
            })
            ->orderByDesc('notices.id')
            ->paginate(20);

        return view('admin.notice_list', [
            'notices' => $notices
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
    public function show(Notice $notice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notice $notice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        //
    }
}
