<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeaseCreateRequest;
use App\Http\Requests\LeaseUpdateRequest;
use App\Models\Apartment;
use App\Models\ApartmentApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class ApplyApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listdata = ApartmentApplication::with('user')
            ->where('resident_id', auth()->id())
            ->get();
        return view('apply_apartment.index', compact('listdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

        $apartment_id = $request->query('apartment_id');

        return view('apply_apartment.create', compact('apartment_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeaseCreateRequest $request)
    {
        try {
            $existingLease = ApartmentApplication::where('resident_id', Auth::user()->id)
                ->whereIn('status', [1, 2])
                ->first();


            if ($existingLease) {
                return redirect()->back()->with('error', 'You have already applied for a apartment.');
            }

            $apartment = new ApartmentApplication();
            $apartment->apartment_id = $request->get('apartment_id');
            $apartment->lease_date = $request->get('lease_date');
            $apartment->lease_end_date = $request->get('lease_end_date');

            $apartment->resident_id = Auth::user()->id;
            $apartment->status = 1;
            if ($request->hasFile('income_proof')) {
                $apartment->income_proof = Storage::disk('public')->putFile('income_proof', $request->file('income_proof'));
            }

            // dd($apartment);
            $apartment->save();

            $flat = Apartment::findOrFail($apartment->apartment_id);
            $flat->status = 2;

            $flat->save();

            return redirect()->route('apply_apartment.index')->with('success', 'Created Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
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
    public function edit(Request $request, $lease_application_id)
    {

        $apartment_id = $request->query('apartment_id');
        $leaseFlat = ApartmentApplication::findOrFail($lease_application_id);
        return view('apply_apartment.edit', compact('leaseFlat', 'apartment_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeaseUpdateRequest $request, string $id)
    {
        try {
            $apartment = ApartmentApplication::findOrFail($id);
            $apartment->apartment_id = $request->get('apartment_id');
            $apartment->lease_date = $request->get('lease_date');
            $apartment->lease_end_date = $request->get('lease_end_date');

            $apartment->resident_id = Auth::user()->id;
            $apartment->status = 1;
            if ($request->hasFile('income_proof')) {
                $apartment->income_proof = Storage::disk('public')->putFile('income_proof', $request->file('income_proof'));
            }
            $apartment->save();

            return redirect()->route('apply_apartment.index')->with('success_msg', 'Created Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $flat = ApartmentApplication::findOrFail($id);
        $flat->apartment->update(['status' => 1]);
        $flat->delete();
        return redirect()->route('apply_apartment.index')->with('success_msg', 'Deleted Successfully');
    }
}
