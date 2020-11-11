<?php

namespace Modules\User\Http\Controllers\Ad;

use App\Models\Ad;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;
use Modules\User\Entities\PhoneVariant;
use Modules\User\Exceptions\UserAdCreationFailed;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdStepController extends Controller
{

    protected $adRepository;

    public function __construct(AdRepositoryInterface $adRepository)
    {
        $this->adRepository = $adRepository;
    }

    public function chooseModel(PhoneBrand $brand)
    {
        $step = AdRepositoryInterface::STEP_CHOOSE_MODEL;

        $routes = [
            'ad' => [
                'create' => route('user.ad.create')
            ]
        ];

        $models = $brand->models;

        return inertia('Ad/Wizard/Create', compact('routes', 'models', 'brand', 'step'));
    }

    public function chooseVariant(PhoneBrand $brand, PhoneModel $model)
    {
        $step = AdRepositoryInterface::STEP_CHOOSE_VARIANT;

        if ($this->adRepository->alreadyHaveDoneStep($step, auth()->user())) {

            return redirect()->route('user.ad.create');
        }

        $routes = [
            'ad' => [
                'create' => route('user.ad.create')
            ],
            'storeVariant' => route('user.ad.step_store_variant')
        ];

        if (!auth()->user()->hasUncompleteAd()) {

            $this->adRepository->create([
                'user_id' => auth()->id(),
                'phone_model_id' => $model->id,
            ]);
        }

        $phone_model_variants = $model->variants;

        return inertia('Ad/Wizard/Create', compact('routes', 'phone_model_variants', 'step'));
    }
}
