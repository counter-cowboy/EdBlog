<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            "title" => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'nullable|file', // required|
            'main_image' => 'nullable|file', // required|
            'category_id' => 'required|integer|exists:categories,id',
            'tag_ids' => 'required|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id'
        ];
    }

    public function messages()
    {
        return [
            "title.required" => 'Field must be fulfilled',
            "title.string" => 'Must be string type',
            'content.required' => 'Field must be fulfilled',
            'content.string' => 'Must be string type',
            'preview_image.required' => 'File must be chosen',
            'preview_image.file' => 'It must be image file',
            'main_image.required' => 'File must be chosen',
            'main_image.file' => 'It must be image file',
            'category_id.required' => 'Field must be fulfilled',
            'category_id.integer' => 'Must be number type',
            'category_id.exists' => 'It must be in Database',
            'tag_ids.array' => 'It must be data array'
        ];
    }
}
