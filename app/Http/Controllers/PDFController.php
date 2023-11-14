<?php

namespace App\Http\Controllers;

use App\Models\License;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PDFController extends Controller
{
    public function preview()
    {
        return view('pdf.license');
    }

    public function generate(int $id)
    {
        // $license = License::findOrFail($id);

        // if (auth()->id() == $license->user_id) return abort(404);

        // $user = auth()->user();

        $pdf = PDF::loadView('pdf.license');

        return ($pdf->stream()->header('charset', 'utf-8'));
    }
}
