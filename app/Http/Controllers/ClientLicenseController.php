<?php

namespace App\Http\Controllers;

use App\Models\License;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ClientLicenseController extends Controller
{
    public function index(Request $request)
    {
        $where_sql = [];

        $licenses = License::query();

        $where_sql[] = ['user_id', '=', auth()->id()];
        if ($request->code) $where_sql[] = ['code', 'LIKE', '%' . $request->code . '%'];
        if ($request->licensesable_id) $where_sql[] = ['licensesable_id', '=', $request->licensesable_id];


        $licenses = $licenses->where($where_sql)
            ->orderByDesc('id')
            ->paginate(app('site')->count_admin ?? 20);

        return view('client.license_list', compact('licenses'));
    }

    public function show(int $id)
    {
        $license = License::findOrFail($id);

        // if (auth()->id() != $license->user_id) return abort(404);

        $pdf = PDF::loadView('pdf.license', compact('license'));

        return $pdf->stream($license->code . '.pdf');
    }
}
