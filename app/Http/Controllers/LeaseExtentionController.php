<?php

namespace App\Http\Controllers;

use App\Models\ApartmentApplication;
use Illuminate\Http\Request;

class LeaseExtentionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit(Request $request, $apartment_application_id)
    {

        $apartment_id = $request->query('apartment_id');
        $leaseApartment = ApartmentApplication::findOrFail($apartment_application_id);
        return view('application_extention.edit', compact('leaseApartment', 'apartment_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'lease_end_date' => [
                'required',
                'date',
                'after:lease_date',
            ],
        ], [
            'lease_end_date.after' => 'The expected apartment end date must be after the start date.',
        ]);


        try {

            $apartment = ApartmentApplication::findOrFail($id);
            $apartment->lease_end_date = $request->get('lease_end_date');
            $apartment->save();

            return redirect()->route('apply_apartment.index')->with('success', 'Updated Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
