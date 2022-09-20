<?php

namespace Database\Seeders;

use App\Models\UserPermission;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studentRole = UserRole::where('name','student')->first();

        if(!($studentRole))
        {
            $roleStudent = UserRole::create(['name' => 'student']);
            $permissionIds = $this->getUserPermission();
            if(count($permissionIds) == 0){
                $permissions = ['application.view','application.edit'];
                for($i = 0; $i<count($permissions); $i++){
                    UserPermission::create([
                    'name'=>$permissions[$i]
                     ]);
                }
            }
            $permissionIds = $this->getUserPermission();
            $roleStudent->userPermissions()->attach($permissionIds);

        }

    }

    /**
     * get user permission
     */

     public function getUserPermission(){
        return UserPermission::pluck('id')->toArray();
     }
}
