<?php

namespace Modules\User\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class AdDetailsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:4', 'max:16'],
            'description' => ['required', 'min:8'],
            'agreement_status' => ['required', 'accepted']
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
