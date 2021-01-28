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

function get_nav_items($navbar = null)
{

    if (is_null($navbar))
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
            ],
            [
                'label' => __(' Bookmarked Ads '),
                'route' => 'user.ad.bookmarked',
                'params' => [],
            ],
            [
                'label' => __(' Seen Ads '),
                'route' => 'user.ad.seen',
                'params' => [],
            ],
            [
                'label' => __(' My Payments '),
                'route' => 'user.payments.list',
                'params' => [],
            ],
        ]);
    else
        $navbar = collect($navbar);

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

function store_dir_to_zip($path, $zip_file = 'archive.zip')
{

    $zip_file = pathinfo($path)['dirname'] . '/' . trim($zip_file, '/');
    $zip = new ZipArchive;

    $zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

    if (!File::exists($path)) mkdir($path);

    $files = new RecursiveDirectoryIterator($path);

    foreach ($files as $file) {

        if (!$file->isDir()) {

            $file_path = $file->getRealPath();

            $zip->addFile($file_path, $file->getBasename());
        }
    }

    $zip->close();

    ob_clean();

    return $zip_file;
}

function format_user_mobile($mobile)
{

    return trim(preg_replace('/^0/', '', $mobile));
}
