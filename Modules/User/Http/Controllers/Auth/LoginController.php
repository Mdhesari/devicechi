<?php

namespace Modules\User\Http\Controllers\Auth;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $data = [];

        if ($message = session('trigger_auth')) {
            $data['trigger_auth'] = $message;
        }

        if ($phone = session('phone')) {
            $data['phone'] = $phone;
        }

        if ($ratelimiter = session('ratelimiter')) {
            $data['ratelimiter'] = $ratelimiter;
        }

        return inertia('Login', $data);
    }
}
