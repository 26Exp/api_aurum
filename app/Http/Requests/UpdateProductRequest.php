<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'manufacturer_id' => 'required|exists:manufacturers,id',
            'name_ru' => 'required|string|max:255',
            'name_ro' => 'required|string|max:255',
            'description_ru' => 'nullable|string|max:255',
            'description_ro' => 'nullable|string|max:255',
            'meta_title_ru' => 'required|string|max:255',
            'meta_description_ru' => 'required|string|max:255',
            'meta_title_ro' => 'required|string|max:255',
            'meta_description_ro' => 'required|string|max:255',
            'images' => 'nullable|array',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'sku' => 'nullable|string|max:255',
            'weight' => 'nullable|numeric',
            'has_variation' => 'boolean',
            'has_discount' => 'boolean',
            'has_badge' => 'boolean',
            'stock' => 'integer',
            'status' => 'nullable|integer',
        ];
    }
}
