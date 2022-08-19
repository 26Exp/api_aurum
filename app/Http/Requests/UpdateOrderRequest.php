<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // check if user is authorized to update order
        return $this->user()->can('update', $this->route('order'));

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address_id' => 'required|exists:user_addresses,id',
            'payment_method_id' => 'required|exists:payment_methods,id',
            'delivery_method_id' => 'required|exists:delivery_methods,id',
            'promocode_id' => 'nullable|exists:promocodes,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.variant_id' => 'required|exists:variants,id',
            'products.*.quantity' => 'required|integer|min:1',
        ];
    }
}
