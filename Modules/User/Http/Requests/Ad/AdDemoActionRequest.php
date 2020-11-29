<?php

namespace Modules\User\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class AdDemoActionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'ad' => ['required'],
            'ad.id' => ['required', 'exists:ads,id']
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
