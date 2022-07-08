<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::user()->role === User::ROLE_ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $category_id = (int)$this->route('category') ?? 0;

        foreach (Category::all() as $category) {
            if ($category->parent_id === $category_id) {
                return [
                    'category_without_child' => 'required|exists:categories,parent_id|different:'.$category_id,
                ];
            }

            //check if exist category
            if (!Category::where('id', $category_id)->exists()) {
                return [
                    'category_not_exist' => 'required|exists:categories,id',
                ];
            }
        }
        return [];

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'category_without_child.required' => 'Удаление категории невозможно, так как есть дочерние категории.',
            'category_not_exist.required'     => 'Удаление категории невозможно, так как она не существует.',
        ];

    }
}
