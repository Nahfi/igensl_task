<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use function PHPUnit\Framework\isNull;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //get role
        $role = Role::where('name','SuperAdmin')->where('guard_name','admin')->first();

        if(!($role))
        {
            // dd('dd');
            $roleSuperAdmin = Role::create(['name' => 'SuperAdmin','guard_name' => 'admin']);
            //permission list for admin  as array
            $permissions = [

                [
                    //dashboard permission
                    'group_name' => 'dashboard',
                    'permissions' => [
                        'dashboard.index',
                    ]
                ],
                [
                    //admin permission
                    'group_name' => 'admin',
                    'permissions' => [
                        'admin.index',
                        'admin.create',
                        'admin.store',
                        'admin.edit',
                        'admin.update',
                        'admin.destroy',
                    ]
                ],
                [
                    //role permission
                    'group_name' => 'role',
                    'permissions' => [
                        'role.index',
                        'role.create',
                        'role.store',
                        'role.edit',
                        'role.update',
                        'role.destroy',
                    ]
                ],
                [
                    //profile permission
                    'group_name' => 'profile',
                    'permissions' => [
                        'profile.edit',
                        'profile.update',
                        'profile.passwordChange'
                    ]
                ],
                [
                    //general settings permission
                    'group_name' => 'settings',
                    'permissions' => [
                        'generalSettings.index',
                        'generalSettings.update',
                    ]
                ],
                [
                    //config settings permission
                    'group_name' => 'settings',
                    'permissions' => [
                        'configSettings.index',
                        'configSettings.optimizeClear',
                        'configSettings.optimize',
                    ]
                ],
                [
                    //user permission
                    'group_name' => 'user',
                    'permissions' => [
                        'user.index',
                        'user.create',
                        'user.store',
                        'user.edit',
                        'user.update',
                        'user.destroy',

                    ]
                ],


            ];

            //asign permisions
            for($i = 0; $i<count($permissions); $i++){
                $permissionGroup = $permissions[$i]['group_name'];

                for($j = 0; $j<count($permissions[$i]['permissions']); $j++){
                    //create permission
                    $permission = Permission::create([
                        'name' => $permissions[$i]['permissions'][$j],
                        'group_name' => $permissionGroup,
                        'guard_name' => 'admin'
                    ]);

                    //assign permission to role
                    $roleSuperAdmin->givePermissionTo($permission);
                    $permission->assignRole($roleSuperAdmin);
                }
            }

        }


    }
}