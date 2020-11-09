<?php

namespace Modules\User\Http\Controllers\Ad;

use App\Models\Ad;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;
use Modules\User\Exceptions\UserAdCreationFailed;

class AdStepController extends Controller
{
    public function chooseModel(PhoneBrand $brand)
    {
        $routes = [
            'ad' => [
                'create' => route('user.ad.create')
            ]
        ];

        $models = $brand->models;

        $step = 2;

        return inertia('Ad/Wizard/Create', compact('routes', 'models', 'brand', 'step'));
    }

    public function chooseVariant(PhoneBrand $brand, PhoneModel $model)
    {

        $routes = [
            'ad' => [
                'create' => route('user.ad.create')
            ]
        ];

        $step = 3;

        if (auth()->user()->hasUncompleteAd($step)) {

            return redirect()->route('user.ad.create');
        }


        if (!auth()->user()->ads()->hasUncompleteAd()) {
            $ad = new Ad;
            $ad->phone_model_id = $model->id;

            $result = auth()->user()->ads()->save($ad);

            if (!$result) {
                // failed
                throw new UserAdCreationFailed;
            }
        }

        $phone_model_variants = $model->variants;

        return inertia('Ad/Wizard/Create', compact('routes', 'phone_model_variants', 'step'));
    }
}
