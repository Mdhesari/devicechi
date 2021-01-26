<?php

namespace App\Http\Requests;

use App\Rules\MobileIran;
use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
            'name' => ['string', 'min:3', 'max:24'],
            'text' => ['string', 'min:10', 'max:2000'],
            'subject' => ['required'],
            'mobile' => ['required', new MobileIran]
        ];
    }
}
