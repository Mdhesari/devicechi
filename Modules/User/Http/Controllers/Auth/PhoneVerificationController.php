<?php

namespace Modules\User\Http\Controllers\Auth;

use Hash;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Validator;

class PhoneVerificationController extends Controller
{

    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function verify(Request $request)
    {

        Validator::make($request->all(), [
            'code' => 'required'
        ]);

        $hashed_verification_code = $request->session()->get('verification_code');

        if (Hash::check($request->code, $hashed_verification_code) && $phone = $request->session('phone')) {

            $user = User::where('phone', $phone)->first();
            $user->createToken();

            // update user phone_verified_at column and return
            $this->guard->login($user, true);

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'phone_verification' => false,
        ]);
    }
}
