<?php

namespace App\Http\Requests\V1\Users;

use Illuminate\Foundation\Http\FormRequest;

class PatchUserForm extends FormRequest
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
            'name'     => ['bail', 'sometimes', 'string', 'between:2,50'],
            'password' => ['bail', 'sometimes', 'string', 'between:8,32'],
        ];
    }
}
