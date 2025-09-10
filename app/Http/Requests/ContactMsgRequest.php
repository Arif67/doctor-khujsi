<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactMsgRequest extends FormRequest
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
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'message' => 'required|string|min:5',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Please enter your name.',
            'email.required'   => 'Your email address is required.',
            'email.email'      => 'Please enter a valid email address.',
            'message.required' => 'Please write a message before sending.',
        ];
    }
}
