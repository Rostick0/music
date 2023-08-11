<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\RemoveClaim;
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
            'remove_claims.id as remove_claim_id',
            'users.name as user_name',
            'users.email as user_email',
            'music.id as music_id',
            'music.title as music_title'
        )
            ->leftJoin('remove_claims', function (JoinClause $join) {
                $join->on('notices.type_id', '=', 'remove_claims.id')
                    ->join('users', 'users.id', '=', 'remove_claims.user_id')
                    ->join('music', 'music.id', '=', 'remove_claims.music_id')
                    ->where('notices.type', '=', 'remove_сlaim');
            })
            ->orderByDesc('notices.id')
            ->paginate(app('site')->count_admin ?? 20);

        $array_ids = array_map(
            fn ($item) => $item['id'],
            [...$notices]
        );

        $reads = Notice::whereIn('id', $array_ids)->update([
            'is_read' => 1
        ]);

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
