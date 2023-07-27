<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Http\Requests\AdminLoginRequest;

class AuthController extends Controller
{
    public const HOME = 'admin.dashboard';

    /**
     * login admin
     *
     * @param AdminLoginRequest $request
     * @return mixed
     */
    public function login(AdminLoginRequest $request)
    {
        $admin = $this->attempt($request->all());

        \Auth::login($admin, $request->boolean('remember_me', false));

        return redirect(route('admin.dashboard'));
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
                'email' => [trans('validation.email', [
                    'attribute' => 'email',
                ])],
            ]);
        }

        return $admin;
    }
}
