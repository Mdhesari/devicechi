<?php

namespace Modules\User\Http\Controllers\Auth;

use App;
use Auth;
use Exception;
use Hash;
use Highlight\RegEx;
use Illuminate\Contracts\Auth\StatefulGuard;
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

    protected $gurad;

    /**
     * code Generator
     *
     * @var CodeVerificationGenerator|null
     */
    protected $codeGenerator = null;

    public function __construct(StatefulGuard $guard, CodeVerificationGenerator $generator)
    {
        $this->gurad = $guard;
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

        $result = $this->sendVerification($user);

        return back()->with('trigger_auth', $result);
    }

    /**
     * Send verification to user by sending multy digit code
     *
     * @param object $user
     * @return void
     */
    protected function sendVerification($user)
    {

        $code = $this->codeGenerator->generate();

        session([
            'phone' => $user->phone,
            'phone_country_code' => $user->phone_country_code,
            'verification_code' => Hash::make($code),
        ]);

        if (App::environment('testing'))
            session()->put('test_code', $code);

        $user->sendVerificationNotification($code);

        return 1;
    }

    /**
     * destroy
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request)
    {

        $this->gurad->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.home');
    }
}
