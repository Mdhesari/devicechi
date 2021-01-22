<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Http\Request;
use App\Models\Ad;
use Modules\User\Http\Requests\Ad\AdStorePictureRequest;
use Modules\User\Space\Contracts\StoresAdPicture;

class AdPictureController extends BaseAdController
{
    public function choose(Ad $ad, Request $request)
    {
        $step = BaseAdController::STEP_UPLOAD_PICTURES;

        $this->checkPreviousSteps($step, $ad);

        $pictures = $ad->pictures;

        $ad_picture_size_limit = config('user.ad_picture_size_limit', 5); // MB
        $ad_pictures_max_count = config('user.ad_pictures_max_count', 9);
        $ad_pictures_min_count = config('user.ad_pictures_min_count', 3);

        $ad_pictures_format = config('user.ad_pictures_format');

        return inertia('Ad/Wizard/Create', compact('step', 'pictures', 'ad_picture_size_limit', 'ad', 'ad_pictures_min_count', 'ad_pictures_max_count', 'ad_pictures_format'));
    }

    public function store(Ad $ad, AdStorePictureRequest $request, StoresAdPicture $driver)
    {
        $pictures = $request->pictures;

        foreach ($pictures as $picture)
            $ad->addMedia($picture)->toMediaCollection(Ad::PICTURES_COLLECTION);

        return redirect()->route('user.ad.step_phone_location', [
            'ad' => $ad,
        ]);
    }

    public function delete(Ad $ad, Request $request, StoresAdPicture $storeDriver)
    {

        $request->validate([
            'picture_id' => ['required', 'exists:media,id'],
        ]);

        $status = $ad->deleteMedia($request->picture_id);

        return response()->json([
            'status' => $status,
        ]);
    }
}
