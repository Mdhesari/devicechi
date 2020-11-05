<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Goutte\Client;
use Modules\User\Entities\PhoneBrand;
use Modules\User\Entities\PhoneModel;
use Modules\User\Http\Controllers\Home\HomeController;
use Symfony\Component\DomCrawler\Link;
use Symfony\Component\HttpClient\HttpClient;

Route::get('/curl', function () {

    $cli = new Client(HttpClient::create(['timeout' => 60]));

    $response = $cli->request('GET', 'https://www.recycledevice.com/sell-mobile');

    $brands = [];

    $response->filter('.brand-list .item')->each(function ($node) use (&$brands) {

        $brands[] = $node->text();
    });

    Log::info($brands);
});

Route::get('/curl-models', function () {

    $cli = new Client(HttpClient::create(['timeout' => 60]));

    $brands = PhoneBrand::all();

    PhoneModel::truncate();

    $db_models = [];

    foreach ($brands as $brand) {

        $response = $cli->request('GET', 'https://www.recycledevice.com/sell-mobile/' . $brand->name);

        $response->filter('.device-list .item')->each(function ($node) use ($brand, &$db_models) {

            $model = $node->text();

            $db_models[] = [
                'brand_name' => $brand->name,
                'name' => $model,
            ];
        });
    }
    Log::info($db_models);
    // PhoneModel::insert($db_models);
});
