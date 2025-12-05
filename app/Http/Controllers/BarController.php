<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use Illuminate\Http\Request;

class BarController extends Controller
{
    public function index()

    {
        $bars = Bar::with('material')->get();
        return view('bars.index', compact('bars'));
    }
    
    public function show(string $locale, Bar $bar)
    {        
        return view('bars.show', compact('bar'));
    }
}
