<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title_ru' => 'required|string|max:255',
            'title_ro' => 'required|string|max:255',
            'content_ru' => 'required|string',
            'content_ro' => 'required|string',
            'meta_title_ru' => 'nullable|string|max:255',
            'meta_title_ro' => 'nullable|string|max:255',
            'meta_description_ru' => 'nullable|string|max:255',
            'meta_description_ro' => 'nullable|string|max:255',
        ];
    }
}
