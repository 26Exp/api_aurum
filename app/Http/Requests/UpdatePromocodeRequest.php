<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdatePromocodeRequest extends FormRequest
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
            'code' => 'required|string|unique:promocodes,code,' . $this->route('promocode')->id,
            'discount' => 'required|numeric|min:0|max:100',
            'active' => 'required|boolean',
            'max_uses' => 'nullable|integer|min:0',
            'expires_at' => 'nullable|date_format:Y-m-d H:i:s',
        ];
    }
}
