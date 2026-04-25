<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicDoctorBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'doctor_id' => ['required', 'exists:doctors,id'],
            'patient_name' => ['required', 'string', 'max:255'],
            'patient_phone' => ['required', 'string', 'max:30'],
            'patient_email' => ['nullable', 'email', 'max:255'],
            'patient_age' => ['required', 'integer', 'min:0', 'max:120'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ];
    }
}
