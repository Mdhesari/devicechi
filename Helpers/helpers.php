<?php

/**
 * Make mobile limiter key
 *
 * @param  App\Models\User\Entities\User $user
 * @return void
 */
function make_mobile_limiter_key($user, $mobile = null)
{
    return $user->id . '|' . ($mobile ?? $user->mobile) . ':send_verification';
}

function get_profile_nav_items()
{

    $navbar = collect([
        [
            'label' => __(' My Profile '),
            'route' => 'user.dashboard',
            'params' => [],
        ],
        [
            'label' => __(' My Ads '),
            'route' => 'user.ad.get',
            'params' => [],
        ]
    ]);

    $navbar = $navbar->map(function ($item, $index) {
        $item['is_active'] = Route::is($item['route']);
        $item['route'] = route($item['route']);

        return $item;
    });

    return $navbar;
}
