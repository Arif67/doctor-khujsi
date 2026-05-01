<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class PatientPrescriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'doctor_name' => ['nullable', 'string', 'max:150'],
            'prescription_date' => ['nullable', 'date'],
            'medicines' => ['nullable', 'string', 'max:1000'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'prescription_file' => [
                'required',
                File::types(['pdf', 'jpg', 'jpeg', 'png', 'webp'])->max(10 * 1024),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => __('Prescription title is required.'),
            'title.max' => __('Prescription title may not be greater than :max characters.', ['max' => 150]),
            'doctor_name.max' => __('Doctor name may not be greater than :max characters.', ['max' => 150]),
            'prescription_date.date' => __('Please enter a valid prescription date.'),
            'medicines.max' => __('Medicines may not be greater than :max characters.', ['max' => 1000]),
            'notes.max' => __('Notes may not be greater than :max characters.', ['max' => 1000]),
            'prescription_file.required' => __('Prescription file is required.'),
            'prescription_file.mimes' => __('Prescription file must be a file of type: :values.', ['values' => 'pdf, jpg, jpeg, png, webp']),
            'prescription_file.max' => __('Prescription file may not be greater than :max kilobytes.', ['max' => 10240]),
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => __('Prescription Title'),
            'doctor_name' => __('Doctor Name'),
            'prescription_date' => __('Prescription Date'),
            'medicines' => __('Medicines'),
            'notes' => __('Notes'),
            'prescription_file' => __('File'),
        ];
    }
}
