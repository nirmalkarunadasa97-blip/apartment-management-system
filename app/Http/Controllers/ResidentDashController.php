<?php

namespace App\Http\Controllers;

use App\Models\Resident;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResidentDashController extends Controller
{
    /**
     * Display a listing of all residents.
     */
    public function index()
    {
        $residents = Resident::with('user')->latest()->paginate(10);
        return view('residents.index', compact('residents'));
    }

    /**
     * Show the form for creating a new resident.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resident in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resident.
     */
    public function show($resident_id)
    {
        $resident = Resident::with('user')->where('resident_id', $resident_id)->firstOrFail();
        return view('residents.show', compact('resident'));
    }

    /**
     * Show the form for editing the specified resident.
     */
    public function edit($resident_id)
    {
        //
    }

    /**
     * Update the specified resident in storage.
     */
    public function update(Request $request, $resident_id)
    {
        //
    }

    /**
     * Remove the specified resident from storage.
     */
    public function destroy($resident_id)
    {
        $resident = Resident::where('resident_id', $resident_id)->firstOrFail();

        if ($resident->nic_copy && Storage::disk('public')->exists($resident->nic_copy)) {
            Storage::disk('public')->delete($resident->nic_copy);
        }

        $resident->delete();

        return redirect()->route('residents.index')->with('success', 'Resident deleted successfully.');
    }
}
