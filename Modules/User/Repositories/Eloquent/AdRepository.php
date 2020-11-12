<?php

namespace Modules\User\Repositories\Eloquent;

use Auth;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Modules\User\Entities\Ad;
use Modules\User\Entities\User;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

class AdRepository extends Repository implements AdRepositoryInterface
{

    public function __construct(Ad $adModel)
    {
        $this->model = $adModel;
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function alreadyHaveDoneStep($step, User $user)
    {

        $result = false;

        $query = $user->ads()->uncompleted();

        switch ($step) {
            case AdRepositoryInterface::STEP_CHOOSE_VARIANT:
                // choose variant step
                $result = $query->hasPhoneVariant();
                break;
            case AdRepositoryInterface::STEP_CHOOSE_ACCESSORY:
                $uncompleted_ad = $query->first();
                $result = $uncompleted_ad ? $uncompleted_ad->hasAccessories() : false;
                break;
            default:
                $result = $query;
        }

        if (is_bool($result)) return $result;

        return $result->count() > 0;
    }

    public function saveAccessories($accessories, User $user)
    {

        $ad = $user->ads()->uncompleted()->firstOrFail();

        return $ad->accessories()->sync($accessories);
    }
}
