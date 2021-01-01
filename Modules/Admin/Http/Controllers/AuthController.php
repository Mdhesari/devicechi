<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\Admin\Entities\Admin;

//TODO:Error handling
class AuthController extends Controller
{
    public const HOME = 'dashboard';
    /**
     * Display a listing of the resource.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $this->validator($request->all())->validate();

        $admin = $this->attempt($request->all());
        \Auth::login($admin, $request->boolean('remember_me', false));
        return redirect(route('dashboard'));
    }
    /**
     * Display a listing of the resource.
     * @return mixed
     */
    public function loginForm()
    {
        return view('admin::auth.login');
    }
    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|Renderable|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        \Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('admin.login'));
    }

    /**
     * Store a newly created resource in storage.
     * @param array $data
     */
    public function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }
    /**
     * Handle a registration request for the application.
     *
     * @param  array  $data
     * @return \Modules\Admin\Entities\Admin|\Illuminate\Http\JsonResponse
     */
    protected function attempt(array $data)
    {

        $admin = Admin::where('email', $data['email'])->first();

        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $admin;
    }
}
