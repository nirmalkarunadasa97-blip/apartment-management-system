<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordUpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view('change_password.edit', compact('data'));
    }

    public function update(PasswordUpdateRequest $request, string $id)
    {
        try {
            $user = User::find($id);

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('success', 'Success');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
