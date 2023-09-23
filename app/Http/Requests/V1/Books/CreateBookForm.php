<?php

namespace App\Http\Requests\V1\Books;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookForm extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => ['bail', 'required', 'string', 'between:1,100'],
            'author'      => ['bail', 'required', 'string', 'between:1,200'],
            'description' => ['bail', 'sometimes', 'nullable', 'string', 'between:1,1000'],
        ];
    }
}
