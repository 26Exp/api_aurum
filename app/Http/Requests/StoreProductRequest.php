<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductRequest extends FormRequest
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
            'out_of_stock_text_ro' => 'nullable|string|max:255',
            'out_of_stock_text_ru' => 'nullable|string|max:255',
            'has_custom_msg' => 'boolean',
            'images' => 'nullable|array',
            'has_discount' => 'boolean',
            'has_badge' => 'boolean',
            'stock' => 'integer',
            'status' => 'nullable|integer',
            'variants' => 'required|array',
            'variants.*.attributes' => 'required|array',
            'variants.*.attributes.*.id' => 'required|integer|exists:attributes,id',
            'variants.*.attributes.*.value_id' => 'required|integer|exists:attribute_values,id',
            'variants.*.price' => 'required|numeric',
            'variants.*.stock' =>'required|integer',
            'variants.*.sku' => 'nullable|unique:variants,sku',
            'variants.*.__id' => 'string|min:3|max:50',
        ];
    }
}
