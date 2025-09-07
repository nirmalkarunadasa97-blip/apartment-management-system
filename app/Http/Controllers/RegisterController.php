<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStoreRequest;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{

    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterStoreRequest $request) {}
}
