<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeletedController extends Controller
{
    public function show(Request $request)
    {
        $text = $request->text;

        return view('admin.deleted', [
            'text' => $text
        ]);
    }
}
