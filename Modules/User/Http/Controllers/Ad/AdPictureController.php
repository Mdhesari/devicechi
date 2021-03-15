<?php

namespace Modules\User\Http\Controllers\Ad;

use Illuminate\Http\Request;
use App\Models\Ad;
use Arr;
use Modules\User\Http\Requests\Ad\AdStorePictureRequest;
use Modules\User\Http\Requests\AdConfirmPictureRequest;
use Modules\User\Space\Contracts\StoresAdPicture;

class AdPictureController extends BaseAdController
{
    public function choose(Ad $ad, Request $request)
    {
        $this->checkAuthorization($ad);

        $step = BaseAdController::STEP_UPLOAD_PICTURES;

        $this->checkPreviousSteps($step, $ad);

        $pictures = $ad->getMedia();

        $ad_picture_size_limit = config('user.ad_picture_size_limit', 5); // MB
        $ad_pictures_max_count = config('user.ad_pictures_max_count', 9);
        $ad_pictures_min_count = config('user.ad_pictures_min_count', 3);

        $ad_pictures_format = config('user.ad_pictures_format');

        $active_picture = $ad->media()->activeOnly()->select('id')->first();

        $active_picture = optional($active_picture)->id;

        $picturesUploaded = false;

        if (session('picturesUploaded')) {
            $picturesUploaded = "ok";
        }

        return inertia('Ad/Wizard/Create', compact('step', 'active_picture', 'picturesUploaded', 'pictures', 'ad_picture_size_limit', 'ad', 'ad_pictures_min_count', 'ad_pictures_max_count', 'ad_pictures_format'));
    }

    public function store(Ad $ad, AdConfirmPictureRequest $request)
    {
        $this->checkAuthorization($ad);

        $ad->media()->activeOnly()->update([
            'custom_properties->active' => false,
        ]);

        $ad->media()->whereId($request->activePicture)->first()->setCustomProperty('active', true)->save();

        return redirect()->route('user.ad.step_phone_location', [
            'ad' => $ad,
        ]);
    }

    public function storeUploads(Ad $ad, AdStorePictureRequest $request)
    {
        $this->checkAuthorization($ad);

        $pictures = Arr::wrap($request->pictures);

        $media = [];

        foreach ($pictures as $picture) {
            $media[] = $ad->addMedia($picture)->toMediaCollection();
        }

        if ($request->expectsJson()) {

            return response([
                'media' => $media
            ]);
        }

        return back()->with('picturesUploaded', true);
    }

    public function delete(Ad $ad, Request $request, StoresAdPicture $storeDriver)
    {
        $this->checkAuthorization($ad);

        $request->validate([
            'picture_id' => ['required', 'exists:media,id'],
        ]);

        $status = $ad->deleteMedia($request->picture_id);

        return response()->json([
            'status' => $status,
        ]);
    }
}
