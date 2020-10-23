<?php

namespace App\Policies;

use Modules\Team\Entities\Team;
use Modules\User\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
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
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \Modules\Team\Entities\Team  $team
     * @return mixed
     */
    public function view(User $user, Team $team)
    {
        return $user->belongsToTeam($team);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \Modules\User\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \Modules\Team\Entities\Team  $team
     * @return mixed
     */
    public function update(User $user, Team $team)
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can add team members.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \Modules\Team\Entities\Team  $team
     * @return mixed
     */
    public function addTeamMember(User $user, Team $team)
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can update team member permissions.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \Modules\Team\Entities\Team  $team
     * @return mixed
     */
    public function updateTeamMember(User $user, Team $team)
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can remove team members.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \Modules\Team\Entities\Team  $team
     * @return mixed
     */
    public function removeTeamMember(User $user, Team $team)
    {
        return $user->ownsTeam($team);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \Modules\User\Entities\User  $user
     * @param  \Modules\Team\Entities\Team  $team
     * @return mixed
     */
    public function delete(User $user, Team $team)
    {
        return $user->ownsTeam($team);
    }
}
