<?php

namespace App\Http\Requests\Projects;

use App\Http\Requests\AbstractFormRequest;

class CreateProjectRequest extends AbstractFormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000']
        ];
    }
}
