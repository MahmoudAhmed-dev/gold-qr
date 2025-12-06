<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Models\Material;
use Illuminate\Http\Request;

class BarController extends Controller
{
    public function index(Request $request)
    {
        $query = Bar::latest()->with('material');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('serial_number', 'like', "%{$search}%");
            });
        }

        if ($request->filled('code') && $request->filled('serial_number')) {
            $query->where('code', $request->input('code'))
                  ->where('serial_number', $request->input('serial_number'));
        }

        $bars = $query->paginate(12);
        return view('bars.index', compact('bars'));
    }
    
    public function show(string $locale, string $barIdentifier)
    {        
        $bar = Bar::where('identifier', $barIdentifier)->with('material')->firstOrFail();
        return view('bars.show', compact('bar'));
    }

    public function create()
    {
        $materials = Material::all();
        return view('bars.create', compact('materials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:bars',
            'serial_number' => 'required|unique:bars',
            'material_id' => 'required|exists:materials,id',
            'weight' => 'required|numeric',
            'fineness' => 'required|numeric',
        ]);

        $validated['identifier'] = base_convert(time(), 10, 36);
        Bar::create($validated);

        return redirect()->route('bars.index', app()->getLocale())->with('success', 'Bar created successfully.');
    }

    public function edit(string $locale, Bar $bar)
    {
        $materials = Material::all();
        return view('bars.edit', compact('bar', 'materials'));
    }

    public function update(Request $request, string $locale, Bar $bar)
    {
        $validated = $request->validate([
            'code' => 'required|unique:bars,code,' . $bar->id,
            'serial_number' => 'required|unique:bars,serial_number,' . $bar->id,
            'material_id' => 'required|exists:materials,id',
            'weight' => 'required|numeric',
            'fineness' => 'required|numeric',
        ]);

        $bar->update($validated);

        return redirect()->route('bars.index', app()->getLocale())->with('success', 'Bar updated successfully.');
    }

    public function destroy(string $locale, Bar $bar)
    {
        $bar->delete();
        return redirect()->route('bars.index', app()->getLocale())->with('success', 'Bar deleted successfully.');
    }
}
