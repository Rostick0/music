<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\Story;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PDFController extends Controller
{
    private $text_path = 'views/pdf/text.blade.php';

    public function edit()
    {
        $content = file_get_contents(
            resource_path($this->text_path)
        );

        return view('admin.pdf_edit', compact('content'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required'
        ]);

        File::put(resource_path($this->text_path), htmlspecialchars_decode($request->content));

        return back();
    }

    public function preview()
    {
        $license = License::findOrFail(1);;
        $user = $license->user;
        // dd($license);

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
