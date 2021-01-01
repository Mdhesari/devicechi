<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Role $role = null)
    {
        $page_title = __(' Access Management ');

        $roles = Role::with('permissions')->get();

        if (!$active_role = $role) {

            $active_role = $roles->first();
        }

        $permissions = Permission::all();

        return view('admin::role-permission.index', compact('page_title', 'roles', 'active_role', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createPermission()
    {
        return view('admin::role-permission.create-permission');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $role = Role::firstOrCreate([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('admin.role-permission.index', [
            'role' => $role,
        ])->with('success', __(' Role Created Successfully.'));
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('admin::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions);

        return back()->with('success', __(' Role was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
