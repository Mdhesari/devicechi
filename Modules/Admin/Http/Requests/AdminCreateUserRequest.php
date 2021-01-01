<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCreateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['min:3', 'string', 'max:255'],
            'mobile' => ['required', 'min:6', 'string', 'max:255', 'unique:users,phone'],
            'password' => ['bail', 'confirmed', 'min:8', 'required_without:email_password'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
