<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientSubscriptionController extends Controller
{
    public function index() {
        return view('client.subscription_list');
    }
}
