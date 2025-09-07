<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'nic' => ['required', 'max:12'],
            'nic_copy' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'max:15'],
            'contact_number' => ['required', 'string', 'regex:/^\+?[0-9]{10,14}$/'],
            'password_confirmation' => ['required'],
        ];
    }
}
