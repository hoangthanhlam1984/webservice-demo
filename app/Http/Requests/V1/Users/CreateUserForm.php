<?php

namespace App\Http\Requests\V1\Users;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserForm extends FormRequest
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
            'name'     => ['bail', 'required', 'string', 'between:2,50'],
            'email'    => ['bail', 'required', 'email', 'unique:users,email'],
            'password' => ['bail', 'required', 'string', 'between:8,32'],
        ];
    }
}
