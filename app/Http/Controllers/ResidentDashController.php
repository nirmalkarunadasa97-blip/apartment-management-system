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
        $users = User::where('user_role_id', 3)->get(); // Only get users with resident role
        return view('residents.create', compact('users'));
    }

    /**
     * Store a newly created resident in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'contact_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'nic' => 'nullable|string|max:20',
            'nic_copy' => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('nic_copy')) {
            $path = $request->file('nic_copy')->store('nic_copy', 'public');
            $validated['nic_copy'] = $path;
        }

        Resident::create($validated);

        return redirect()->route('residents.index')->with('success', 'Resident added successfully.');
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
        $resident = Resident::where('resident_id', $resident_id)->firstOrFail();
        $users = User::where('user_role_id', 3)->get();
        return view('residents.edit', compact('resident', 'users'));
    }

    /**
     * Update the specified resident in storage.
     */
    public function update(Request $request, $resident_id)
    {
        $resident = Resident::where('resident_id', $resident_id)->firstOrFail();

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'contact_number' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'nic' => 'nullable|string|max:20',
            'nic_copy' => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('nic_copy')) {
            // Delete old file if exists
            if ($resident->nic_copy && Storage::disk('public')->exists($resident->nic_copy)) {
                Storage::disk('public')->delete($resident->nic_copy);
            }

            $path = $request->file('nic_copy')->store('nic_copy', 'public');
            $validated['nic_copy'] = $path;
        }

        $resident->update($validated);

        return redirect()->route('residents.index')->with('success', 'Resident updated successfully.');
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
