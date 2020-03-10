<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompleteTodoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'todo_id' => 'required',
        ];
    }
}
