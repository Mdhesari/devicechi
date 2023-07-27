<?php

namespace Modules\User\Policies;

use App\Models\Ad;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\User\Entities\User;

class AdPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \Modules\User\Entities\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \App\Models\Ad  $Ad
     * @return mixed
     */
    public function view(User $user, Ad $ad)
    {
        return $user->id === $ad->user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Modules\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \App\Models\Ad  $Ad
     * @return mixed
     */
    public function update(User $user, Ad $ad)
    {
        return $user->id === $ad->user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \App\Models\Ad  $Ad
     * @return mixed
     */
    public function delete(User $user, Ad $ad)
    {
        return $user->id === $ad->user->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \App\Models\Ad  $Ad
     * @return mixed
     */
    public function restore(User $user, Ad $ad)
    {
        return $user->id === $ad->user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \App\Models\Ad  $Ad
     * @return mixed
     */
    public function forceDelete(User $user, Ad $ad)
    {
        return $user->id === $ad->user->id;
    }
}
