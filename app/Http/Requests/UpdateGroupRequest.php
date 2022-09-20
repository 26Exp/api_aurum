<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use const http\Client\Curl\AUTH_ANY;

class UpdateGroupRequest extends FormRequest
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
            'name_ru' => 'required|string|max:255',
            'name_ro' => 'required|string|max:255',
            'description_ru' => 'required|string|max:255',
            'description_ro' => 'required|string|max:255',
            'meta_title_ru' => 'required|string|max:255',
            'meta_title_ro' => 'required|string|max:255',
            'meta_description_ru' => 'required|string|max:255',
            'meta_description_ro' => 'required|string|max:255',
        ];
    }
}
