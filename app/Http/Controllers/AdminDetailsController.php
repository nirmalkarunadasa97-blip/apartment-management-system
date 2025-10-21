<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listdata = User::with('userRole')
            ->where('user_role_id', '!=', 3)
            ->get();

        return view('admin_staff.index', compact('listdata'));
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
    public function edit(string $user_id)
    {
        $data = User::with('userRole')
            ->where('id', $user_id)
            ->first();

        return view('admin_staff.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateRequest $request, string $id)
    {
        try {

            $user = User::find($id);
            $user->is_active = $request->get('status');
            $user->save();

            return redirect()->route('admin_staff.index')->with('success', 'Updated Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $user = User::find($id);
            $user->delete();

            return redirect()->route('admin_staff.index')->with('success', 'Deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
