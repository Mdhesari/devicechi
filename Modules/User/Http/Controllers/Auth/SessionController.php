<?php

namespace Modules\User\Http\Controllers\Auth;

use App;
use Hash;
use Illuminate\Cache\RateLimiter;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\User\Events\UserRegistered;
use Modules\User\Http\Requests\UserLoginRequest;
use Modules\User\Space\Contracts\CodeVerificationGenerator;
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
    public function store(UserLoginRequest $request, RateLimiter $limiter)
    {
        $user = User::wherePhone($request->input('phone'))->first();

        if (is_null($user)) {

            $user = User::create([
                'phone' => trim($request->phone),
                'phone_country_code' => intval($request->phone_country_code)
            ]);

            event(new UserRegistered(
                $user,
            ));
        }

        $key = make_mobile_limiter_key($user);

        if ($limiter->tooManyAttempts($key, 1)) {

            return back()->with([
                'trigger_auth' => true,
                'ratelimiter' => $this->getAvailableInRateLimiter($limiter, $key)
            ]);
        }

        $limiter->hit($key, 120);

        $this->sendVerification($user);

        return back()->with([
            'trigger_auth' => true,
            'ratelimiter' => $this->getAvailableInRateLimiter($limiter, $key)
        ]);
    }

    private function getAvailableInRateLimiter(RateLimiter $limiter, $key)
    {

        return now()->addSeconds($limiter->availableIn($key))->diffInSeconds();
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
