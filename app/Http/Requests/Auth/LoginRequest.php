<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\AbstractFormRequest;

class LoginRequest extends AbstractFormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
    }

    public function messages(): array
    {
       return [
         'email.required' => 'The email is required.',
         'password.request'  => 'The password is required.'
       ];
    }
}
