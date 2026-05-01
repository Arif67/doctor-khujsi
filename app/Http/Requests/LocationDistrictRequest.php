<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationDistrictRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $districtId = $this->route('district')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('location_districts', 'name')->ignore($districtId),
            ],
            'bn_name' => ['nullable', 'string', 'max:255'],
            'division_id' => ['nullable', 'integer', 'min:1'],
            'lat' => ['nullable', 'string', 'max:255'],
            'lon' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
        ];
    }
}
