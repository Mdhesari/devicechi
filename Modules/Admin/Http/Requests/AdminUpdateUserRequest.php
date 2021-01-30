<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Request;

class AdminUpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['nullable', 'min:3', 'string', 'max:255'],
            'mobile' => ['nullable', 'min:6', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'confirmed', 'min:8'],
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
