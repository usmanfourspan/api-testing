<?php

namespace App\Http\Requests\Projects;

use App\Http\Requests\AbstractFormRequest;

class CreateProjectRequest extends AbstractFormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'user_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
          'user_id.required' => 'The project requires an owner.'
        ];
    }
}
