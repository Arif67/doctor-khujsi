<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $areaId = $this->route('area')?->id;

        return [
            'district_id' => ['required', 'exists:location_districts,id'],
            'thana_id' => ['required', 'exists:location_thanas,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('location_areas', 'name')
                    ->ignore($areaId)
                    ->where(fn ($query) => $query->where('thana_id', $this->input('thana_id'))),
            ],
            'bn_name' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
        ];
    }
}
