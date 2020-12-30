<?php

namespace Modules\User\Http\Controllers\Auth;

use App;
use App\Exceptions\MFSValidationException;
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
use Modules\User\Space\Traits\HasMobileRateLimit;
use Validator;

class SessionController extends Controller
{
    protected $guard;

    /**
     * code Generator
     *
     * @var CodeVerificationGenerator|null
     */
    protected $codeGenerator = null;

    public function __construct(StatefulGuard $guard, CodeVerificationGenerator $generator)
    {
        $this->guard = $guard;
        $this->codeGenerator = $generator;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(UserLoginRequest $request, RateLimiter $limiter)
    {
        $mobile = trim(preg_replace('/^0/', '', $request->phone));

        $user = User::wherePhone($mobile)->first();

        if (is_null($user)) {

            $user = User::create([
                'phone' => $mobile,
                'phone_country_code' => intval($request->phone_country_code)
            ]);

            event(new UserRegistered(
                $user,
            ));
        }

        $key = make_mobile_limiter_key($user);

        if ($limiter->tooManyAttempts($key, 1)) {

            throw new MFSValidationException([
                'trigger_auth' => true,
                'ratelimiter' => $this->getAvailableInRateLimiter($limiter, $key)
            ]);
        }

        $limiter->hit($key, config('user.mobile_rate_limit'));

        $this->sendVerification($user);

        return back()->with([
            'trigger_auth' => true,
            'ratelimiter' => $this->getAvailableInRateLimiter($limiter, $key)
        ]);
    }

    /**
     * Verify if user entered code is true
     *
     * @param  object $request
     * @return mixed
     */
    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        $hashed_verification_code = $request->session()->get('verification_code');

        $phone = $request->session()->get('phone');

        if (Hash::check($request->code, $hashed_verification_code) && $phone) {

            $user = User::where('phone', $phone)->first();

            $user->verifyPhoneNumberIfNotVerified();

            // update user phone_verified_at column and return
            $this->guard->login($user, true);

            return redirect()->route('user.dashboard')->with('submit_status', 1);
        }

        return back()->withErrors([
            'code' => __('auth.failed'),
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

        $user->sendVerificationNotification(compact('code'));
    }

    /**
     * destroy
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request)
    {

        $this->guard->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.home');
    }
}
