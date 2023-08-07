<?php

namespace App\Http\Controllers;

use App\Models\RemoveClaim;
use Illuminate\Http\Request;

class RemoveClaimController extends Controller
{

    public function show(RemoveClaim $removeClaim)
    {
        //
    }

    public function edit(int $id)
    {
        $remove_claim = RemoveClaim::findOrFail($id);

        $status = [
            'processed',
            'reviewed',
            'closed'
        ];

        return view('admin.remove_claim_edit', [
            'remove_claim' => $remove_claim,
            'status' => $status
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'status' => 'required|max:255',
        ]);

        RemoveClaim::find($id)->update($validated);

        return back();
    }

    public function destroy(RemoveClaim $removeClaim)
    {
        //
    }
}
