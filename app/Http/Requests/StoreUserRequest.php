<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        return [
            'name' => 'required|min:8|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения',
            'name.min' => 'Имя должно быть не менее 8 символов',
            'name.max' => 'Имя должно быть не более 50 символов',
            'email.required' => 'Поле "E-mail" обязательно для заполнения',
            'email.email' => 'Неверный формат почтового адреса',
            'email.unique' => 'Пользователь с таким e-mail уже существует',
            'password.required' => 'Поле "Пароль" обязательно для заполнения',
            'password.confirmed' => 'Пароли не совпадают',
            'password.min' => 'Пароль должен быть не менее 8 символов',
        ];
    }
}
