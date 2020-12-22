<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Log;
use Modules\User\Entities\Ad;
use Modules\User\Entities\User;
use Modules\User\Events\UserLoggedIn;
use Modules\User\Events\UserRegistered;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;
use Response;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request, AdRepositoryInterface $adRepository)
    {

        $user = $request->user();

        $all_status = $adRepository->getAllStatus();

        $success_session = session('success');

        $tabs = [];

        $nav_items = get_profile_nav_items();

        return inertia('User/Profile', compact('success_session', 'user', 'tabs', 'nav_items'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['nullable', 'email'],
            'phone' => ['required', 'not_regex:/^0+/'],
            'phone_country_code' => ['required'],
            'password' => ['nullable', 'min:8', 'confirmed']
        ]);

        $request->user()->update($request->only('name', 'email'));

        return back()->with('success', __(' Ok '));
    }
}
