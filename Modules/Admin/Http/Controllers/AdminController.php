<?php

namespace Modules\Admin\Http\Controllers;

use App\Grids\AdminsGrid;
use App\Grids\AdminsSingleGrid;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use Modules\Admin\Http\Requests\AdminStoreRequest;
use Modules\Admin\Notifications\SendPasswordToUser;
use Modules\Admin\Transformers\LoginViewResource;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Http\Requests\AdminUpdateRequest;
use App\Models\Role;
use Session;
use Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {

        $page_title = __(' User Profile ');

        $admin = $request->user()->load('roles');

        return view('admin::profile.show', compact('page_title', 'admin'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function list(Request $request, AdminsGrid $adminsGrid)
    {
        $page_title = __(' Admins List ');

        $query = Admin::query();

        return $adminsGrid
            ->create(compact('query', 'request'))
            ->renderOn('admin::grid.index', compact('page_title'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $roles = Role::all();
        $page_title = __(' Submit Admin ');

        return view('admin::admins.create', compact('page_title', 'roles'));
    }

    public function store(AdminStoreRequest $request)
    {
        if (is_null($request->password)) {

            $request->password = random_password();
        }

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$admin)
            return back()->with('error', __(' Unable to create user. '));

        $admin->assignRole($request->role);

        event(new Registered($admin));

        $admin->notify(new SendPasswordToUser($request->password));

        return redirect()->back()->with('success', __(' User created successfully. '));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Admin $admin, AdminsSingleGrid $grid, Request $request)
    {

        $page_title = __(' Admin Profile ');
        $show_title = __(' Admin Profile ');

        $query = Admin::query();

        $query->whereId($admin->id);

        $grid = $grid->create(compact('request', 'query'));

        $columns = $grid->getProcessedColumns();
        $item = collect($grid->getData()->items())->first();

        return view('admin::global.show', compact(
            'item',
            'columns',
            'grid',
            'show_title',
            'page_title'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param Admin $admin
     * @return Renderable
     */
    public function edit(Admin $admin)
    {
        $page_title = __(' Edit User ');
        $roles = Role::all();
        return view('admin::admins.edit', compact('page_title', 'admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     * @param AdminUpdateRequest $request
     * @param Admin $admin
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Admin $admin, AdminUpdateRequest $request)
    {

        // more email validation for not existing
        $request->validate([
            'email' => [Rule::unique('admins')->ignore($request->user()->id)]
        ]);

        if (empty($admin->toArray())) {

            $admin = $request->user();
        }

        $password = false;

        if (is_null($request->password) && $request->boolean('email_password')) {

            $password = random_password();
        } else {

            $password = $request->password;
        }

        $data = array_filter($request->all(), fn ($value) => !is_null($value) && $value !== '');

        if ($password)
            $data['password'] = Hash::make($password);

        $admin->update($data);

        if (isset($data['role'])) {
            $admin->assignRole($data['role']);
        }

        if ($password) {

            $admin->notify(new SendPasswordToUser($password));
        }

        if (!$admin)
            return back()->with('error', __(' Unable to update profile. '));

        return redirect()->back()->with('success', __(' Profile updated successfully. '));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Admin $admin)
    {

        $name = $admin->name;

        // soft delete
        $result = $admin->delete();

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
    public function forceDestroy(Admin $admin)
    {

        $name = $admin->name;

        $result = $admin->forceDelete();

        if ($result) {

            Session::flash('success', __(' User :name successfully force deleted! ', [
                'name' => $name,
            ]));
        }

        return redirect()->route('admin.dashboard');
    }

    public function approveDestroy(Admin $admin)
    {

        $page_title = __(' Delete User ');

        return view('admin::admins.delete', compact('admin', 'page_title'));
    }

    public function restore(Admin $admin)
    {

        if ($admin->trashed()) {

            $result = $admin->restore();

            if ($result)
                Session::flash('success', __('Successfully restored user.'));
        }

        return back();
    }
}
