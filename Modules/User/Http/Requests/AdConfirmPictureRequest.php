<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdConfirmPictureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'pictures' => [
                'required',
                'min:' . config('user.ad_pictures_min_count'),
                'max:' . config('user.ad_pictures_max_count'),
            ],
            'activePicture' => ['required', 'exists:media,id']
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
