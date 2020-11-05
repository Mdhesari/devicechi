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
use Modules\User\Http\Controllers\Home\HomeController;
use Symfony\Component\HttpClient\HttpClient;

Route::get('/curl', function () {

    $cli = new Client(HttpClient::create(['timeout' => 60]));

    // $response = $cli->request('GET', 'https://www.recycledevice.com/sell-mobile');

    // $brands = [];

    // $response->filter('.brand-list')->each(function ($node) use (&$brands) {

    //     $brands = explode(' ', $node->text());
    // });

    

    $response = $cli->request('GET', 'https://www.recycledevice.com/sell-mobile');


});
