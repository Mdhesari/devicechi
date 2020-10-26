<?php

namespace Modules\User\Http\Controllers\Auth;

use Exception;
use Highlight\RegEx;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Events\UserRegistered;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Response;
use Str;
use Validator;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'phone' => ['min:6', 'max:10', 'not_regex:/^0+/'],
            'phone_country_code' => ['required']
        ])->validateWithBag('createUser');

        $user = User::where('phone', $request->input('phone'))->first();

        if (!is_null($user)) {
            // user already have an account

            return null; // temp

            // return $this->loginUser($user);
        }

        return $this->registerUser($request);
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

            $phone = trim($request->phone);
            $phone_code = intval($request->phone_country_code);

            User::create([
                'phone' => $phone,
                'phone_country_code' => $phone_code
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

            return back()->with('error', __('Something went wrong'));
        }
    }
}
