<?php

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
