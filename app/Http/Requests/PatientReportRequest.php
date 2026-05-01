<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class PatientReportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'report_type' => ['nullable', 'string', 'max:100'],
            'report_date' => ['nullable', 'date'],
            'description' => ['nullable', 'string', 'max:1000'],
            'report_file' => [
                'required',
                File::types(['pdf', 'jpg', 'jpeg', 'png', 'webp'])->max(10 * 1024),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => __('Report title is required.'),
            'title.max' => __('Report title may not be greater than :max characters.', ['max' => 150]),
            'report_type.max' => __('Report type may not be greater than :max characters.', ['max' => 100]),
            'report_date.date' => __('Please enter a valid report date.'),
            'description.max' => __('Notes may not be greater than :max characters.', ['max' => 1000]),
            'report_file.required' => __('Report file is required.'),
            'report_file.mimes' => __('Report file must be a file of type: :values.', ['values' => 'pdf, jpg, jpeg, png, webp']),
            'report_file.max' => __('Report file may not be greater than :max kilobytes.', ['max' => 10240]),
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => __('Report Title'),
            'report_type' => __('Report Type'),
            'report_date' => __('Report Date'),
            'description' => __('Notes'),
            'report_file' => __('File'),
        ];
    }
}
