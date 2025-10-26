<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Measurement;

class MeasurementHistoryController extends Controller
{
    /**
     * Display list of all measurements
     */
    public function index()
    {
        $measurements = Measurement::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('measurements.index', compact('measurements'));
    }

    /**
     * Display single measurement detail
     */
    public function show($id)
    {
        $measurement = Measurement::findOrFail($id);

        // Get previous measurement for comparison
        $previousMeasurement = Measurement::where('id', '<', $id)
            ->orderBy('id', 'desc')
            ->first();

        return view('measurements.show', compact('measurement', 'previousMeasurement'));
    }

    /**
     * Display printable version of measurement
     */
    public function print($id)
    {
        $measurement = Measurement::findOrFail($id);

        return view('measurements.print', compact('measurement'));
    }

    /**
     * Delete measurement
     */
    public function destroy($id)
    {
        $measurement = Measurement::findOrFail($id);
        $measurement->delete();

        return redirect()->route('measurements.index')
            ->with('success', 'Riwayat pengukuran berhasil dihapus');
    }
}
