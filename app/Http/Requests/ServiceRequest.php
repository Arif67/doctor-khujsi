<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
        return [
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'title' => 'required|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_bn' => 'nullable|string',
        ];
    }
}
