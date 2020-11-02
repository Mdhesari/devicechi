<?php

namespace Modules\User\Http\Controllers\Home;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\User\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Show home page
     *
     * @return void
     */
    public function index(Request $request)
    {

        $data =  [
            'routes' => [
                'user_auth' => route('user.auth'),
                'user_auth_verify' => route('user.verify')
            ]
        ];

        if ($message = session('trigger_auth')) {

            $data['trigger_auth'] = $message;
        }

        if ($phone = session('phone')) {

            $data['phone'] = $phone;
        }


        return Inertia::render('Home', $data);
    }
}
