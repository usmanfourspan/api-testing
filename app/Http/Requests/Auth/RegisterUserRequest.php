<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\AbstractFormRequest;

class RegisterUserRequest extends AbstractFormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name is required.',
            'email.required' => 'The email is required.',
            'password.required' => 'The password is required.'
        ];
    }
}
