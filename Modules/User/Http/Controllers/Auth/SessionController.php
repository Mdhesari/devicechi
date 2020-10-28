<?php

namespace Modules\User\Http\Controllers\Auth;

use App;
use Exception;
use Hash;
use Highlight\RegEx;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Events\UserRegistered;
use Modules\User\Space\Contracts\CodeVerificationGenerator;
use NunoMaduro\Collision\Adapters\Phpunit\State;
use Response;
use Str;
use Validator;

class SessionController extends Controller
{

    /**
     * code Generator
     *
     * @var CodeVerificationGenerator|null
     */
    protected $codeGenerator = null;

    public function __construct(CodeVerificationGenerator $generator)
    {
        $this->codeGenerator = $generator;
    }

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

        if (is_null($user)) {

            $phone = trim($request->phone);
            $phone_code = intval($request->phone_country_code);

            // user already have an account
            $user = User::create([
                'phone' => $phone,
                'phone_country_code' => $phone_code
            ]);

            event(new UserRegistered(
                $user,
            ));
        }

        $result = $this->verify($user);

        return back()->with('trigger_auth', $result);
    }

    /**
     * Verify user by sending muly digit code
     *
     * @param object $user
     * @return void
     */
    protected function verify($user)
    {

        $code = $this->codeGenerator->generate();

        session([
            'phone' => $user->phone,
            'phone_country_code' => $user->phone_country_code,
            'verification_code' => Hash::make($code),
        ]);

        if (App::environment('testing'))
            session()->put('test_code', $code);

        $result = $user->sendVerificationNotification($code);

        return 1;
    }
}
