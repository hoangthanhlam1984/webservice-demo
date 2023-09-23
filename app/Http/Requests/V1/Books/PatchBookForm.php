<?php

namespace App\Http\Requests\V1\Books;

class PatchBookForm extends CreateBookForm
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => ['bail', 'sometimes', 'nullable', 'string', 'between:1,100'],
            'author'      => ['bail', 'sometimes', 'nullable', 'string', 'between:1,200'],
            'description' => ['bail', 'sometimes', 'nullable', 'string', 'between:1,1000'],
        ];
    }
}
