<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    /**
     * Show the form for creating a new user (staff or admin).
     */
    public function create()
    {
        // Get roles for dropdown (admin and staff)
        $roles = UserRole::whereIn('user_role', ['admin', 'staff'])->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'user_role_id' => 'required|exists:user_roles,user_role_id',
        ]);

        // Auto-generate password
        $password = Str::random(10);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->user_role_id = $request->user_role_id;
        $user->password = Hash::make($password);
        $user->is_active = 1;
        $user->save();

        // Return back with success message including generated password
        return redirect()->route('admin-users.create')->with('success', 'User created successfully. Generated password: ' . $password);
    }
}
