<?php

namespace Modules\User\Http\Controllers\Auth;

use Hash;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Validator;

class PhoneVerificationController extends Controller
{
    public function verify(Request $request)
    {

        Validator::make($request->all(), [
            'code' => 'required'
        ]);

        $hashed_verification_code = $request->session()->get('verification_code');

        if (Hash::check($request->code, $hashed_verification_code)) {

            // update user phone_verified_at column and return
            return back();
        }

        return back()->withErrors([
            'phone_verification' => false,
        ]);
    }
}
