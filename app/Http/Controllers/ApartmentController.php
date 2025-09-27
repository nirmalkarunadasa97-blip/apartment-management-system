<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::all();
        return view('addash.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('addash.apartments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contact_no' => 'nullable|string|max:255',
            'no_of_bedroom' => 'nullable|integer|min:0',
            'no_of_bathroom' => 'nullable|integer|min:0',
            'apartment_no' => 'required|string|max:255',
            'monthly_rent' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('apartments', 'public');
            $data['photo'] = $photoPath;
        }

        Apartment::create($data);

        return redirect()->route('apartments.index')->with('success', 'Apartment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $apartment = Apartment::findOrFail($id);
        return view('addash.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $apartment = Apartment::findOrFail($id);
        return view('addash.apartments.edit', compact('apartment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'contact_no' => 'nullable|string|max:255',
            'no_of_bedroom' => 'nullable|integer|min:0',
            'no_of_bathroom' => 'nullable|integer|min:0',
            'apartment_no' => 'required|string|max:255',
            'monthly_rent' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $apartment = Apartment::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($apartment->photo) {
                Storage::disk('public')->delete($apartment->photo);
            }
            $photoPath = $request->file('photo')->store('apartments', 'public');
            $data['photo'] = $photoPath;
        }

        $apartment->update($data);

        return redirect()->route('apartments.index')->with('success', 'Apartment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $apartment = Apartment::findOrFail($id);
        $apartment->delete();

        return redirect()->route('apartments.index')->with('success', 'Apartment deleted successfully.');
    }
}
