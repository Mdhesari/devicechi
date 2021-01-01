<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\UsersGrid;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Admin\Entities\User;
use Modules\Admin\Http\Requests\AdminCreateUserRequest;
use Modules\Admin\Http\Requests\AdminUpdateUserRequest;
use Modules\Admin\Notifications\sendPasswordToUser;
use Session;

class UserController extends Controller
{


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {

        $page_title = __(' Submit User ');

        return view('admin::users.create', compact('page_title'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminCreateUserRequest $request)
    {

        if (is_null($request->password)) {

            $request->password = $password = random_password();
        } else {

            $password = $request->password;
        }

        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        if (!$user)
            return redirect()->back()->with('error', __(' Unable to create user. '));

        event(new Registered($user));

        $request->user()->notify(new sendPasswordToUser($password));

        return redirect()->back()->with('success', __(' User created successfully. '));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function list(Request $request, UsersGrid $usersGrid)
    {
        $query = User::query();

        $page_title = __(' Users List ');

        return $usersGrid
            ->create(compact('query', 'request'))
            ->renderOn('admin::grid.index', compact('page_title'));

        // return view('admin::users.show', compact('users', 'page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(User $user)
    {

        $page_title = __(' Edit User ');

        return view('admin::users.edit', compact('page_title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(AdminUpdateUserRequest $request, User $user)
    {
        $request->validate([
            'mobile' => [Rule::unique('users')->ignore($user->id)]
        ]);

        $data = [
            'name' => $request->name,
            'mobile' => $request->mobile,
        ];

        $email_password = $request->boolean('email_password');

        if ($request->password || $email_password) {

            if (is_null($request->password))
                $request->password = random_password();

            $user->notify(new sendPasswordToUser($request->password));

            $data['password'] = Hash::make($request->password);
        }

        $result = $user->update($data);

        if (!$result) return redirect()->back()->with('error', __(' Unable To Update User. '));

        return redirect()->back()->with('success', __(' User Successfully Updated. '));
    }

    public function show(User $user)
    {

        $page_title = __(' User Profile ');

        return view('admin::users.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(User $user)
    {

        $name = $user->name;

        // soft delete
        $result = $user->delete();

        if ($result) {

            Session::flash('success', __(' User :name successfully deleted! ', [
                'name' => $name,
            ]));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function forceDestroy(User $user)
    {

        $name = $user->name;

        $user->profile()->delete();
        $user->webinars()->delete();
        $user->payments()->delete();
        $user->profile()->delete();
        $user->transactions()->delete();
        $user->files()->delete();
        $user->tickets()->sync([]);
        $user->favorites()->sync([]);
        // $user->mutatedWebinars()->sync([]);
        $user->discounts()->sync([]);
        $user->resetPassword()->delete();

        $result = $user->forceDelete();

        if ($result) {

            Session::flash('success', __(' User :name successfully force deleted! ', [
                'name' => $name,
            ]));
        }

        return redirect()->route('admin.users.list');
    }

    public function approveDestroy(User $user)
    {

        $page_title = __(' Delete User ');

        return view('admin::users.delete', compact('user', 'page_title'));
    }

    public function restore(User $user)
    {

        if ($user->trashed()) {

            $result = $user->restore();

            if ($result)
                Session::flash('success', __('Successfully restored user.'));
        }

        return back();
    }
}
