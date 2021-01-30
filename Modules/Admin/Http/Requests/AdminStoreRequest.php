<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['min:3', 'string', 'max:255', 'unique:admins'],
            'email' => ['email', 'string', 'max:255', 'unique:admins'],
            'password' => ['min:8', 'string', 'max:255', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
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
