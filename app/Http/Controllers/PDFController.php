<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\Story;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PDFController extends Controller
{
    public function preview()
    {
        $license = License::findOrFail(1);

        dd(Story::find(1))
;        $user = $license->user;
        dd($license);

        // dd($user->subscription_last->subscription_type);

        return view('pdf.license', compact('license'));
    }

    public function generate(int $id)
    {
        $license = License::findOrFail($id);

        // if (auth()->id() != $license->user_id) return abort(404);

        $pdf = PDF::loadView('pdf.license', compact('license'));

        return $pdf->stream($license->code . '.pdf');
    }
}
