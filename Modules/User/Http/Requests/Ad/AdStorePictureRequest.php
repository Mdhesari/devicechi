<?php

namespace Modules\User\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Repositories\Eloquent\AdRepository;

class AdStorePictureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $adRepository = app(AdRepository::class);

        $ad = $adRepository->getUserUncompletedAd();;

        $pictures_validation = ['array'];
        $pictures_count = $ad->pictures()->count();

        if ($pictures_count > 0) {

            $entire_pictures_count = 9 - $pictures_count;
            $pictures_validation[] = 'max:' . $entire_pictures_count;

            if ($entire_pictures_count > 6) {

                $pictures_validation[] = 'min:' . ($entire_pictures_count - 6);
            }
        } else {

            $pictures_validation[] = 'min:3';
            $pictures_validation[] = 'max:9';
        }

        return [
            'pictures' => $pictures_validation,
            'pictures.*' => ['image', 'mimes:png,jpg,jpeg', 'max:5120']
        ];
    }

    public function messages()
    {
        return [
            'max' => __('user::ads.form.error.pictures.max'),
            'min' => __('user::ads.form.error.pictures.min'),
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
