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
            case 3:
                // choose variant step
                $result = $query->hasPhoneVariant();
                break;
            default:
                $result = $query;
        }

        return $result->count() > 0;
    }
}
