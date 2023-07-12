<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\StatisticType;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $statistic_types = StatisticType::all();

        $where_sql = [];

        if ($request->email)  $where_sql[] = ['users.email', 'LIKE', '%' . $request->email . '%'];

        $statistics = Statistic::select(
            'statistics.*',
            'statistic_types.name as statistics_name',
            'users.email as user_email',
            'music.title as music_title'
        )
            ->join('users', 'users.id', '=', 'statistics.users_id')
            ->join('statistic_types', 'statistic_types.id', '=', 'statistics.statistic_types_id')
            ->leftJoin('music', 'music.id', '=', 'statistics.music_id')
            ->where($where_sql)
            ->orderByDesc('statistics.id');

        if ($request->statistic_types) {
            // dd($restatistic_types);
            $statistics->whereIn('statistic_types.id', $request->statistic_types);
        }

        $statistics = $statistics->paginate(20);

        return view('admin.statistic_list', [
            'statistics' => $statistics,
            'statistic_types' => $statistic_types,
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
    public function show(Statistic $statistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Statistic $statistic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Statistic $statistic)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Statistic $statistic)
    {
        //
    }
}
