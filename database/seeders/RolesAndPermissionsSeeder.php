<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gardName = config('auth.defaults.guard');
        $permissionsByRole = [
            'admin' => [
                /* Settings */
                'settings',
                'settings.users',
                /*roles*/
                'roles.index',
                'roles.show',
                'roles.create',
                'roles.edit',
                'roles.rolesPermissions',
                'roles.destroy',

                /*users*/
                'users.index',
                'users.show',
                'users.create',
                'users.edit',
                'users.destroy',

                /*catrgories*/
                'catrgories.index',
                'catrgories.show',
                'catrgories.create',
                'catrgories.edit',
                'catrgories.destroy',
            ],
        ];

        $insertPermissions = fn($role) => collect($permissionsByRole[$role])
            ->map(fn($name) => DB::table(config('permission.table_names.permissions'))->insertGetId(['name' => $name, 'group' => ucfirst(explode('.', str_replace('_', ' ', $name))[0]), 'guard_name' => $gardName, 'created_at' => now(),]))
            ->toArray();

        $permissionIdsByRole = [
            'admin' => $insertPermissions('admin'),
        ];

        foreach ($permissionIdsByRole as $roleName => $permissionIds) {
            $role = Role::whereName($roleName)->first();
            if (!$role) {
                $role = Role::create([
                    'name' => $roleName,
                    'description' => 'Best for business owners and company administrators',
                    'guard_name' => $gardName,
                    'created_at' => now(),
                ]);
            }
            DB::table(config('permission.table_names.role_has_permissions'))
                ->insert(
                    collect($permissionIds)->map(fn($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id,
                    ])->toArray()
                );
            $users = User::where('id', 1)->get();
            foreach ($users as $user) {
                $user->assignRole($role);
               // $user->syncPermissions($role->permissions);
            }
        }
    }
}

