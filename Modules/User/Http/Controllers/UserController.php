<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Log;
use Modules\User\Entities\User;
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
        return 'user home';
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'phone' => ['min:6', 'max:10'],
            'phone_country_code' => ['required']
        ])->validateWithBag('createUser');

        $user = User::where('phone', $request->input('phone'))->first();

        if (!is_null($user)) {

            return $this->loginUser($request);
        }

        return $this->registerUser($request);
    }

    /**
     * Login user
     *
     * @return void
     */
    private function loginUser($request)
    {

        return Response::json([
            'user_is_alread_loggedin',
        ]);
    }

    /**
     * Register new user
     *
     * @param  mixed $request
     * @return void
     */
    private function registerUser($request)
    {

        try {

            User::create([
                'phone' => $request->input('phone'),
            ]);

            event(new UserRegistered(
                $request,
            ));

            if ($request->expectsJson())
                return Response::json([
                    'status' => 1,
                ]);

            return back()->with('trigger_auth', 1);
        } catch (Exception $e) {

            report($e);

            return Response::json([
                'status' => 0,
            ]);
        }
    }
}
