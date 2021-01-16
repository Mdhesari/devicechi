<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Rules\MobileIran;
use Illuminate\Validation\ValidationException;
use Modules\User\Entities\City;
use Modules\User\Entities\Country;
use Modules\User\Entities\User;
use Modules\User\Repositories\Contracts\AdRepositoryInterface;

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

        $tabs = [];

        $nav_items = get_nav_items();

        $user->load('city');

        $user_country = Country::whereName(config('user.default_country'))->first();

        $cities = City::whereCountryId($user_country->id)->get();

        return inertia('User/Profile', compact('user', 'tabs', 'nav_items', 'cities'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => ['required', 'min:3'],
            'phone' => ['required', new MobileIran],
            'phone_country_code' => ['required'],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'city_id' => ['nullable', 'exists:cities,id']
        ]);

        $user = $request->user();

        $data = $request->only('name', 'phone');

        $city_id = $request->input('city_id');

        $data['city_id'] = empty($city_id) ? null : $city_id;

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

        return back()->with('toSuccess', __(' Ok '));
    }

    public function bookmarks(Request $request)
    {

        $ads = $request->user()->bookmarkedAds;

        $tabs = [];

        $nav_items = get_nav_items();

        return inertia('User/MySavedAds', compact('ads', 'tabs', 'nav_items'));
    }

    public function seens(Request $request)
    {

        $ads = $request->user()->seenAds;

        $tabs = [];

        $nav_items = get_nav_items();

        return inertia('User/MySavedAds', compact('ads', 'tabs', 'nav_items'));
    }
}
