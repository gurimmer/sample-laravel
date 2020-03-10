<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTodoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
        ];
    }
}
