<?php

/**
 * Make mobile limiter key
 *
 * @param  App\ModelsUser $user
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


/**
 * Get url host
 *
 * @param  string $url
 * @return string
 */
function get_url_host($url)
{

    $url = parse_url($url);

    $host = optional($url)['host'];

    return $host;
}

/**
 * randomPassword
 *
 * @return string
 */
function random_password()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
