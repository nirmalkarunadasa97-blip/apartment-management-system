<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaintenanRequest;
use App\Models\ApartmentApplication;
use App\Models\Maintenance;
use App\Models\MaintenanceType;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listdata = Maintenance::with(['maintenanceType', 'apartment'])
            ->where('resident_id', auth()->id())
            ->get();

        return view('maintenance.index', compact('listdata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tenantId = auth()->user()->id;
        $ApartmentId = ApartmentApplication::where('resident_id', $tenantId)
            ->where('status', 2)
            ->value('apartment_id');

        $maintenanceType = MaintenanceType::get();
        return view('maintenance.create', compact('maintenanceType', 'ApartmentId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaintenanRequest $request)
    {
        try {

            $maintenance = new Maintenance();
            $maintenance->apartment_id = $request->get('apartment_id');
            $maintenance->description = $request->get('description');
            $maintenance->maintenance_type_id = $request->get('maintenance_type');
            $maintenance->status = 1;
            $maintenance->resident_id = Auth::user()->id;
            $maintenance->save();

            return redirect()->route('maintenance.index')->with('success_msg', 'Created Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
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
    public function edit(string $id)
    {
        $maintenanceRequest = Maintenance::with('maintenanceType', 'apartment')->find($id);
        $maintenanceType = MaintenanceType::all();

        return view('maintenance.edit', compact('maintenanceRequest', 'maintenanceType'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(MaintenanRequest $request, string $id)
    {
        try {

            $maintenance = Maintenance::findOrFail($id);

            $maintenance->apartment_id = $request->get('apartment_id');
            $maintenance->description = $request->get('description');
            $maintenance->maintenance_type_id = $request->get('maintenance_type');
            $maintenance->save();

            return redirect()->route('maintenance.index')->with('success_msg', 'Created Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        return redirect()->route('maintenance.index')->with('success_msg', 'Deleted Successfully');
    }
}
