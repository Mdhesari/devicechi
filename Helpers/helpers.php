<?php

/**
 * Make mobile limiter key
 *
 * @param  App\Models\User\Entities\User $user
 * @return void
 */
function make_mobile_limiter_key($user)
{
    return $user->id . '|' . $user->mobile . ':send_verification';
}
