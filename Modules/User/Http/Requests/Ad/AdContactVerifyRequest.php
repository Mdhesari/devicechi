<?php

namespace Modules\User\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;

class AdContactVerifyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'verification_code' => ['required', 'min:3'],
            'ad_contact_id' => ['required', 'exists:ad_contacts,id']
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
