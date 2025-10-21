<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminMaintenanceRequest;
use App\Models\Maintenance;
use App\Models\MaintenanceType;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->user_role_id == 1) {

            $listdata = Maintenance::with(['user', 'maintenanceType', 'apartment'])->get();

            return view('admin_maintenance.index', compact('listdata'));
        } else if (auth()->user()->user_role_id == 2) {

            $listdata = Maintenance::with(['user', 'maintenanceType', 'apartment'])
                ->where('staff_id', auth()->user()->id)
                ->get();
            return view('admin_maintenance.index', compact('listdata'));
        }
    }



    public function updateStatus($maintenance_id)
    {
        $done = Maintenance::findOrFail($maintenance_id);
        $done->status = 3;
        $done->save();

        return redirect()->back()->with('success', 'Updated Successfully');
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
    public function edit(string $id)
    {
        $maintenanceRequest = Maintenance::with('maintenanceType')->find($id);
        $maintenanceType = MaintenanceType::all();
        $staff = User::where('user_role_id', 2)->where('is_active', 1)->get();

        return view('admin_maintenance.edit', compact('maintenanceRequest', 'maintenanceType', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminMaintenanceRequest $request, string $id)
    {
        try {
            $staff = Maintenance::findOrFail($id);

            $staff->staff_id = $request->get('staff');
            $staff->status = 2;
            $staff->save();


            return redirect()->route('admin_maintenance.index')->with('success_msg', 'Updated Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error_msg', 'Something went wrong!');
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
