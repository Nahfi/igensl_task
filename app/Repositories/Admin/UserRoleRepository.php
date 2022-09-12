<?php
namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Models\UserPermission;
use App\Models\UserRole;
use App\Services\FileService;
use Illuminate\Support\Facades\Hash;

class UserRoleRepository{

    /**
     * get all useer role information
     *
     * @return void
     */
    public function index(){
        return UserRole::with('userPermissions')->latest()->first();
    }

    /**
     * get all useer permission information
     *
     * @return void
     */
    public function permission(){
        return UserPermission::latest()->get();
    }

    /**
     * update user role permission
     */
    public function update($request){
        $role = $this->index();
        $role->userPermissions()->detach();
        $role->userPermissions()->attach($request->permissionIds);
    }
}