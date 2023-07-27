<?php

namespace Modules\Admin\Database\Seeders;

use Arr;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Log;
use Spatie\Permission\Models\Permission;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = collect(config('admin.permissions'));

        $permissions = $permissions->map(fn ($name) => ['name' => $name, 'guard_name' => 'web']);

        if (Permission::count() > 0) {
            $permissions = $permissions->filter(fn ($name) => !(Permission::whereName($name)->exists()));
        }

        $data = $permissions->toArray();

        if (!empty($data)) {
            Permission::insert($data);
        }

        $roles = collect(config('admin.roles'));

        $roles->map(function ($role_permissions, $name) {

            $role = Role::firstOrCreate(['name' => $name, 'guard_name' => 'web']);

            $permissions = Permission::query();

            foreach ($role_permissions as $perm) {

                if ($perm == '*') {
                    // do nothing because we want all permissions

                } else if (str_starts_with($perm, '!')) {

                    $perm = substr($perm, strpos($perm, '!') + 1);

                    $permissions = $permissions->where('name', '!=', $perm);
                } else {

                    $permissions = $permissions->whereName($perm);
                }
            }

            $role->givePermissionTo($permissions->pluck('id'));
        });
    }
}
