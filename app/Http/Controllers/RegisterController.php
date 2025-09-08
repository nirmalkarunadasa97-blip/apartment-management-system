<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStoreRequest;
use App\Models\Resident;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterStoreRequest $request)
    {
        try {
            $user = new User();
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->user_role_id = 3;
            $user->password = Hash::make($request->get('password'));
            $user->is_active = 1;
            $user->save();

            $resident = new Resident();

            $resident->contact_number = $request->get('contact_number');
            $resident->nic = $request->get('nic');
            $resident->nic_copy = Storage::disk('public')->putFile('nic_copy', $request->file('nic_copy'));
            $resident->address = $request->get('address');
            $resident->user_id = $user->id;

            $resident->save();

            return redirect()->route('login')->with('success', 'Success');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
