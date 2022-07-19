<?php

namespace App\Http\Requests;

use App\Models\Language;
use App\Models\Product;
use App\Models\User;
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
        return Auth::user()->role === User::ROLE_ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'category_id' => 'required|integer|exists:categories,id',
            'vendor_id' => 'required|integer|exists:vendors,id',
            'discount_id' => 'nullable|integer|exists:discounts,id',
            'status' => 'required|in:' . implode(',', Product::STATUSES),
            'hasCustomMessage' => 'required|boolean',
            'meta_keywords' => 'nullable|string',
            'variations' => 'json',
        ];

        return Language::generateRules([
            'name' => 'string|required|min:3|max:255',
            'description' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'out_of_stock_text' => 'nullable|string|max:70',
        ], $rules);
    }
}
