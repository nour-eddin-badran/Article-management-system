<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Model::unguard();

        foreach (Role::all() as $role) {
            $role->permissions()->sync([]);


            $permissions = config('role_permissions');
            $routePermissionMapper = config('route_permissions');

            if (empty($permissions[$role->name])) {
                continue;
            }

            foreach ($permissions[$role->name] as $permissionName) {
                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'route_name' => $routePermissionMapper[$permissionName],
                    'guard_name' => 'web'
                ]);
            }

            $role->givePermissionTo($permissions[$role->name]);
        }

        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
