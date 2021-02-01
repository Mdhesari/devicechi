<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\UsersGrid;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
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
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->mobile,
            'password' => Hash::make($request->password),
        ]);

        if (!$user)
            return redirect()->back()->with('error', __(' Unable to create user. '));

        event(new Registered($user));

        $user->notify(new sendPasswordToUser($password));

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

        if (!$request->input('sort_by')) {

            $request->merge([
                'sort_by' => 'created_at',
                'sort_dir' => 'desc',
            ]);
        }

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

        $data = $request->only(['name', 'mobile', 'password']);

        $data['phone'] = $data['mobile'];

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

    public function show(User $user, UsersGrid $usersGrid, Request $request)
    {

        $page_title = __(' User Profile ');
        $show_title = __(' User Profile ');

        $query = User::query();

        $query->whereId($user->id);

        $grid = $usersGrid->create(compact('request', 'query'));

        $columns = $grid->getProcessedColumns();
        $item = collect($grid->getData()->items())->first();

        return view('admin::global.show', compact(
            'user',
            'item',
            'columns',
            'grid',
            'show_title',
            'page_title'
        ));
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

        if (!$result)
            throw ValidationException::withMessages([
                'user' => __('Unable to delete user'),
            ]);

        return redirect()->back()->with('success', __(' User :name successfully deleted! ', [
            'name' => $name,
        ]));
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
        $user->files()->delete();
        $user->tickets()->sync([]);
        $user->favourites()->sync([]);
        $user->mutatedWebinars()->sync([]);
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
    public function search(Request $request)
    {
        if ($request->expectsJson()) {

            $query = User::query();

            $search = $request->input('query');

            $ignore = $request->input('ignore');

            if (!empty($ignore)) {

                $query->whereNotIn('id', $ignore);
            }

            $users = $query->searchLike('name', $search)->limit(config('admin.auto_complete_limit'))->get();

            return $users;
        }
    }
}
