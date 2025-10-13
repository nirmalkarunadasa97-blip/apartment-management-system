<?php

namespace App\Http\Controllers;

use App\Models\ApartmentApplication;
use App\Models\Maintenance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentYear = Carbon::now()->year;
        $startYear = $currentYear - 4;

        $annualUserRegistrationData = User::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as registration_count')
        )
            ->where('user_role_id', 3)
            ->whereBetween(DB::raw('YEAR(created_at)'), [$startYear, $currentYear])
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy('year')
            ->pluck('registration_count', 'year');


        $annualMaintenanceRequestData = Maintenance::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as maintenance_count')
        )
            ->whereBetween(DB::raw('YEAR(created_at)'), [$startYear, $currentYear])
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy('year')
            ->pluck('maintenance_count', 'year');

        $annualApartmentApplicationData = ApartmentApplication::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as lease_application')
        )
            ->whereBetween(DB::raw('YEAR(created_at)'), [$startYear, $currentYear])
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->orderBy('year')
            ->pluck('lease_application', 'year');

        return view('report.index', compact('annualUserRegistrationData', 'annualMaintenanceRequestData', 'annualApartmentApplicationData'));
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
