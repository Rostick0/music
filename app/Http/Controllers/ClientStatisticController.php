<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientStatisticController extends Controller
{
    public function index_client()
    {
        return view('client.statistic_list');
    }
}
