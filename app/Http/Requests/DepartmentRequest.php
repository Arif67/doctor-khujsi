<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepartmentRequest extends FormRequest
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
        $id = $this->route('department'); 
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')->ignore($id),
            ],
            'code' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('departments', 'code')->ignore($id),
            ],
            'short_name' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ];
    }
}
