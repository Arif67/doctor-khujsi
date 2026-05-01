<?php

namespace App\Http\Requests;

use App\Models\LocationArea;
use App\Models\LocationThana;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class DoctorRequest extends FormRequest
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
         $id = $this->route('doctor'); 
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('doctors', 'email')->ignore($id),
            ],
            'phone' => 'nullable|string|max:20',
            'office_phone' => 'nullable|string|max:20',
            'department_id' => 'nullable|exists:departments,id',
            'speciality' => 'nullable|string|max:255',
            'experience' => 'nullable|string|max:255',
            'district_id' => 'nullable|exists:location_districts,id',
            'thana_id' => 'nullable|exists:location_thanas,id',
            'area_id' => 'nullable|exists:location_areas,id',
            'status' => 'required|in:active,inactive',
            'show_on_homepage' => 'nullable|boolean',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',

            // Educations
            'educations' => 'nullable|array',
            'educations.*.title' => 'nullable|string|max:255',
            'educations.*.details' => 'nullable|string|max:500',

            // Shifts
            'shifts' => 'nullable|array',
            'shifts.*.day' => 'nullable|string|max:20',
            'shifts.*.start_time' => 'nullable|string|max:10',
            'shifts.*.end_time' => 'nullable|string|max:10',

            // Social links
            'social_links' => 'nullable|array',
            'social_links.*.platform' => 'nullable|string|max:50',
            'social_links.*.url' => 'nullable|url',
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $districtId = $this->integer('district_id') ?: null;
            $thanaId = $this->integer('thana_id') ?: null;
            $areaId = $this->integer('area_id') ?: null;

            if ($thanaId && ! LocationThana::query()->whereKey($thanaId)->where('district_id', $districtId)->exists()) {
                $validator->errors()->add('thana_id', 'Selected thana does not belong to the selected jila.');
            }

            if ($areaId && ! LocationArea::query()->whereKey($areaId)->where('thana_id', $thanaId)->exists()) {
                $validator->errors()->add('area_id', 'Selected area does not belong to the selected thana.');
            }
        });
    }
}
