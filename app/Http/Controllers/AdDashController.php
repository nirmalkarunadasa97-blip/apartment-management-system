<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdDashController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminCount = User::where('user_role_id', 1)->where('is_active', 1)->count();
        $staffCount = User::where('user_role_id', 2)->where('is_active', 1)->count();
        $residentCount = User::where('user_role_id', 3)->where('is_active', 1)->count();

        return view('addash.index', compact(
            'staffCount',
            'adminCount',
            'residentCount',
        ));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
