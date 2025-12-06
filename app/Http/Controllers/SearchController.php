<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function find(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'serial_number' => 'required',
        ]);

        $bar = Bar::where('code', $request->code)
                  ->where('serial_number', $request->serial_number)
                  ->first();

        if ($bar) {
            return redirect()->route('bars.show', [app()->getLocale(), $bar->id]);
        }

        return back()->with('error', __('bars.bar_not_found'))->withInput();
    }
}
