<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserRole;
use App\Repositories\Admin\UserRoleRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserRoleController extends Controller
{
      /**
     * construct a method
     */
    public $user,$userRoleRepository;
    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->userRoleRepository = $userRoleRepository;
    }

    /**
     * get all role inforamtion
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        $role = $this->userRoleRepository->index();
        $permissions = $this->userRoleRepository->permission();
        return view('admin.pages.user_role.index',[
            'role' => $role,
            'permissions'=>$permissions
        ]);
    }


    /**
     * update a specefied role information
     */
    public function update(Request $request,$id){
        if(is_null($this->user) || !$this->user->can('user.edit')){
            abort(403,'Unauthorized access');
        }
        $this->userRoleRepository->update($request,$id);
        return back()->with('user_role_update_success','User Role Permission Update Successfully');
    }




}
