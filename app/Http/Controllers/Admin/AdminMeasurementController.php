<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Measurement;
use Illuminate\Http\Request;

class AdminMeasurementController extends Controller
{
    public function index(Request $request)
    {
        $query = Measurement::query();

        // Search filter
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('classified_size_right', 'LIKE', "%{$search}%")
                  ->orWhere('classified_size_left', 'LIKE', "%{$search}%")
                  ->orWhere('id', 'LIKE', "%{$search}%");
            });
        }

        // Size filter
        if ($request->has('size') && $request->size != '') {
            $query->where('classified_size_right', $request->size);
        }

        $measurements = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.measurements.index', compact('measurements'));
    }

    public function show(Measurement $measurement)
    {
        return view('admin.measurements.show', compact('measurement'));
    }

    public function destroy(Measurement $measurement)
    {
        $measurement->delete();

        return redirect()->route('admin.measurements.index')
            ->with('success', 'Measurement deleted successfully.');
    }
}
