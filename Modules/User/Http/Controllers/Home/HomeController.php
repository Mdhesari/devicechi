<?php

namespace Modules\User\Http\Controllers\Home;

use Inertia\Inertia;
use Modules\User\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Show home page
     *
     * @return void
     */
    public function index()
    {

        return Inertia::render('Home', [
            'routes' => ['user_auth' => route('user.auth')]
        ]);
    }
}
