<?php

namespace Modules\User\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Log;
use App\Models\Ad;
use App\Rules\MobileIran;
use Hash;
use Illuminate\Validation\ValidationException;
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

        $tabs = collect([
            [
                'text' => __('user::ads.tabs.all'),
                'params' => [],
            ],
        ]);

        $nav_items = get_profile_nav_items();

        return inertia('User/Profile', compact('success_session', 'user', 'tabs', 'nav_items'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => ['required', 'min:3'],
            'phone' => ['required', new MobileIran],
            'phone_country_code' => ['required'],
            'password' => ['nullable', 'min:8', 'confirmed']
        ]);

        $user = $request->user();

        $data = $request->only('name', 'phone');

        $data['phone'] = format_user_mobile($data['phone']);

        $existing_user = User::wherePhone($data['phone'])->first();

        if (is_null($existing_user)) {

            $user->setPhoneUnverified();
        } else if (!$user->is($existing_user)) {

            throw ValidationException::withMessages([
                'phone' => trans('validation.exists', [
                    'attribute' => __(' Phone '),
                ]),
            ]);
        }

        if ($password = $request->input('password')) {

            $user->setNewPassword($password);
        }

        $user->update($data);

        return back()->with('success', __(' Ok '));
    }
}
