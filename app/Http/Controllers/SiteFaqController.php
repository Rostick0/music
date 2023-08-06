<?php

namespace App\Http\Controllers;

use App\Models\SiteFaq;
use Illuminate\Http\Request;

class SiteFaqController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required|max:65536'
        ]);

        SiteFaq::firstOrCreate($validated);

        return back();
    }

    public function edit(int $id)
    {
        $faq = SiteFaq::findOrFail($id);

        return view('admin.faq_edit', [
            'faq' => $faq
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'question' => 'required|max:255',
            'answer' => 'required|max:65536'
        ]);

        SiteFaq::find($id)->update($validated);

        return back();
    }

    public function destroy(int $id)
    {
        SiteFaq::destroy($id);

        return back();
    }
}
