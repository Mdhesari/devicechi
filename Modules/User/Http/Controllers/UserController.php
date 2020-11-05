<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Log;
use Modules\User\Entities\User;
use Modules\User\Events\UserLoggedIn;
use Modules\User\Events\UserRegistered;
use Response;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $routes = [
            'ad' => [
                'create' => route('user.ad.create')
            ],
        ];

        return inertia('User/Profile', [
            'user' => auth()->user(),
            'routes' => $routes,
        ]);
    }
}
