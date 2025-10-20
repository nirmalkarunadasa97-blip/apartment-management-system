<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeaseCreateRequest extends FormRequest
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
            'lease_date' => ['required', 'date', 'after_or_equal:today'],
            'lease_end_date' => ['required', 'date', 'after:lease_date'],
            'income_proof' => ['required'],
        ];
    }
}
