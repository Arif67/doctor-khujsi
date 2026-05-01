<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationThanaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $thanaId = $this->route('thana')?->id;

        return [
            'district_id' => ['required', 'exists:location_districts,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('location_thanas', 'name')
                    ->ignore($thanaId)
                    ->where(fn ($query) => $query->where('district_id', $this->input('district_id'))),
            ],
            'bn_name' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
        ];
    }
}
