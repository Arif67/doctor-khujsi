<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
         $id = $this->patient->id ?? null; 
         $rules = [
            'first_name'   => 'required|string|max:100',
            'last_name'   => 'required|string|max:100',
            'email' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'email')->ignore($id),
            ],
            'phone'        => 'nullable|string|max:20',
            'mobile'       => 'nullable|string|max:20',
            'blood'        => 'nullable|string|max:10',
            'sex'          => 'nullable|string|in:Male,Female',
            'date_of_birth'=> 'nullable|date',
            'address'      => 'nullable|string',
            'photo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];

        if ($this->isMethod('post')) {
            $rules['password'] = 'required';
        }

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['password'] = 'nullable';
        }

        return $rules;
    }
}
