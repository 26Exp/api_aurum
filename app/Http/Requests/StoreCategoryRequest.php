<?php

namespace App\Http\Requests;

use App\Models\Language;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'parent_id' => 'nullable|integer|exists:categories,id',
        ];

        return Language::generateRules([
            'name' => 'required|min:3|max:50',
            'description' => 'required',
            'meta_title' => 'required|min:3|max:'. config('custom.page.meta_title_max_length'),
            'meta_description' => 'required|min:8|max:'. config('custom.page.meta_description_max_length'),
        ], $rules);
    }
}
