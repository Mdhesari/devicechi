<?php

namespace Modules\User\Http\Requests\Ad;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Modules\User\Repositories\Eloquent\AdRepository;

class AdStorePictureRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        $ad_picture_size_limit = config('user.ad_picture_size_limit', 5); // MB
        $ad_pictures_max_count = config('user.ad_pictures_max_count', 9);
        $ad_pictures_min_count = config('user.ad_pictures_min_count', 3);

        if (isset($request->ad)) $ad = $request->ad;

        else $ad = app(AdRepository::class)->getUserUncompletedAd();

        $pictures_validations = ['required', 'array'];

        $pictures_count = $ad->getMedia()->count();

        // here we want to check if stored pictures count on database are not higher than max pics or less than min pics validation.

        if ($pictures_count > 0) {

            $max_pictures_to_upload = $ad_pictures_max_count - $pictures_count;

            $min_pictures_to_upload = $ad_pictures_max_count - $max_pictures_to_upload;

            $pictures_validations[] = 'max:' . $max_pictures_to_upload;

            // if ($min_pictures_to_upload < $ad_pictures_min_count) {

            //     $ad_pictures_min_count -= $min_pictures_to_upload;

            //     $pictures_validations[] = 'min:' . $ad_pictures_min_count;
            // }
        } else {

            // $pictures_validations[] = 'min:' . $ad_pictures_min_count;
            $pictures_validations[] = 'max:' . $ad_pictures_max_count;
        }

        return [
            'pictures' => $pictures_validations,
            'pictures.*' => ['image', 'mimes:png,jpg,jpeg', 'max:' . ($ad_picture_size_limit * 1024)]
        ];
    }

    public function messages()
    {
        return [
            'max' => __('user::ads.form.error.pictures.max', [
                'limit' => config('user.ad_pictures_max_count'),
            ]),
            'min' => __('user::ads.form.error.pictures.min', [
                'limit' => config('user.ad_pictures_min_count'),
            ]),
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
