<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogRequest extends FormRequest
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
         $id = $this->route('blog');
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('blogs', 'title')->ignore($id),
            ],
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'status' => 'nullable|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:255',
            'thumbnail_image' => $id ? 'nullable|image|mimes:jpg,png,jpeg,gif,webp|max:2048' : 'nullable|image|mimes:jpg,png,jpeg,gif,webp|max:2048',
            'featured_image' => $id ? 'nullable|image|mimes:jpg,png,jpeg,gif,webp|max:4096' : 'nullable|image|mimes:jpg,png,jpeg,gif,webp|max:4096',
        ];
    }
}
