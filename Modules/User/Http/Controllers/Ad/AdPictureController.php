<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Log;
use Modules\User\Entities\AdPicture;
use Modules\User\Space\Contracts\StoresAdPicture;
use Storage;

class AdPictureController extends BaseAdController
{
    public function choose(Request $request)
    {
        $step = BaseAdController::STEP_UPLOAD_PICTURES;

        $this->checkPreviousSteps($step);

        $ad = $this->adRepository->getUserUncompletedAd();

        $pictures = $ad->pictures;

        $ad_picture_size_limit = config('user.ad_picture_size_limit');

        return inertia('Ad/Wizard/Create', compact('step', 'pictures', 'ad_picture_size_limit'));
    }

    public function store(Request $request, StoresAdPicture $driver)
    {
        $ad = $this->adRepository->getUserUncompletedAd();;

        $pictures_count = $ad->pictures()->count();
        $pictures_validation = ['array'];

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

        $request->validate([
            'pictures' => $pictures_validation,
            'pictures.*' => ['image', 'mimes:png,jpg,jpeg', 'max:5120']
        ], [
            'max' => __('user::ads.form.error.pictures.max'),
            'min' => __('user::ads.form.error.pictures.min'),
        ]);

        $pictures = $request->pictures;

        foreach ($pictures as $picture) {

            $path = $driver->store($picture, $ad);

            $picture = new AdPicture;
            $picture->url = $path;

            $ad->pictures()->save($picture);
        }

        return redirect()->route('user.ad.step_phone_location');
    }

    public function delete(Request $request, StoresAdPicture $storeDriver)
    {

        $request->validate([
            'picture_id' => ['required', 'exists:ad_pictures,id'],
        ]);

        $picture = AdPicture::find($request->picture_id);

        $picture_url = $picture->getAttributes()['url'];

        $status = $picture->delete();

        if ($status) {

            $result = $storeDriver->deleteStoredPicture($picture_url);
            $status = $result;
        }


        return response()->json([
            'status' => $status,
        ]);
    }
}
