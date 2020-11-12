<?php

namespace Modules\User\Http\Controllers\Ad;

use App\Models\Ad;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\PhoneAccessory;
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

        if ($this->adRepository->alreadyHaveDoneStep($step, auth()->user())) {

            return redirect()->route('user.ad.step_phone_accessories');
        }

        $models = $brand->models;

        return inertia('Ad/Wizard/Create', compact('models', 'brand', 'step'));
    }

    public function chooseVariant(PhoneBrand $brand, PhoneModel $model)
    {
        $step = AdRepositoryInterface::STEP_CHOOSE_VARIANT;

        if ($this->adRepository->alreadyHaveDoneStep($step, auth()->user())) {

            return redirect()->route('user.ad.step_phone_accessories');
        };

        if (!auth()->user()->hasUncompleteAd()) {

            $this->adRepository->create([
                'user_id' => auth()->id(),
                'phone_model_id' => $model->id,
            ]);
        }

        $phone_model_variants = $model->variants;

        return inertia('Ad/Wizard/Create', compact('phone_model_variants', 'step'));
    }

    public function chooseAccessory(Request $request)
    {
        $step = AdRepositoryInterface::STEP_CHOOSE_ACCESSORY;

        if ($this->adRepository->alreadyHaveDoneStep($step, auth()->user())) {

            return redirect()->route('user.ad.create');
        }

        $accessories = PhoneAccessory::all();

        return inertia('Ad/Wizard/Create', compact('accessories', 'step'));
    }
}
