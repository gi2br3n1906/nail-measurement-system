<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SizeStandard;
use Illuminate\Http\Request;

class SizeStandardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $standards = SizeStandard::orderBy('size_name')->get();
        return view('admin.size-standards.index', compact('standards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.size-standards.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'size_name' => 'required|string|max:10',
            'jempol' => 'required|numeric|min:0',
            'telunjuk' => 'required|numeric|min:0',
            'tengah' => 'required|numeric|min:0',
            'manis' => 'required|numeric|min:0',
            'kelingking' => 'required|numeric|min:0',
            'tolerance' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        SizeStandard::create($validated);

        return redirect()->route('admin.size-standards.index')
            ->with('success', 'Size standard created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SizeStandard $sizeStandard)
    {
        return view('admin.size-standards.show', compact('sizeStandard'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SizeStandard $sizeStandard)
    {
        return view('admin.size-standards.edit', compact('sizeStandard'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SizeStandard $sizeStandard)
    {
        $validated = $request->validate([
            'size_name' => 'required|string|max:10',
            'jempol' => 'required|numeric|min:0',
            'telunjuk' => 'required|numeric|min:0',
            'tengah' => 'required|numeric|min:0',
            'manis' => 'required|numeric|min:0',
            'kelingking' => 'required|numeric|min:0',
            'tolerance' => 'required|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $sizeStandard->update($validated);

        return redirect()->route('admin.size-standards.index')
            ->with('success', 'Size standard updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SizeStandard $sizeStandard)
    {
        $sizeStandard->delete();

        return redirect()->route('admin.size-standards.index')
            ->with('success', 'Size standard deleted successfully.');
    }
}
