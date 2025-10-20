<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ApartmentApplication;
use Illuminate\Http\Request;

class ApartmentApplicationAdminontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listdata = ApartmentApplication::with('user')->get();
        return view('apply_apartment_admin.index', compact('listdata'));
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $apartment_application_id)
    {
        $apartment_id = $request->query('apartment_id');
        $leaseApartment = ApartmentApplication::findOrFail($apartment_application_id);
        return view('apply_apartment_admin.edit', compact('leaseApartment', 'apartment_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $apartment = ApartmentApplication::findOrFail($id);
            $apartment->status = $request->get('status');
            $apartment->save();

            if ($apartment->status == 3 || $apartment->status == 4) {
                $flat = Apartment::findOrFail($apartment->apartment_id);
                $flat->status = 1;
                $flat->save();
            }

            return redirect()->route('apply_apartment_admin.index')->with('success', 'Created Successfully');
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
