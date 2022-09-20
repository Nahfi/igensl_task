<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Models\Country;
use App\Repositories\Admin\UserRepository;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * construct a method
     */
    public $user,$userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->userRepository = $userRepository;
    }

    /**
     * get all user inforamtion
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        $users = $this->userRepository->index();

        return view('admin.pages.user.index',[
            'users' => $users,
        ]);
    }

    /**
     * show create new user form
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('user.create')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.user.create');
    }

    /**
     * Store a new user
     */
    public function store(UserStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('user.create')){
            abort(403,'Unauthorized access');
        }
        $this->userRepository->create($request);
        return back()->with('user_store_success','User Store Successfully');
    }

    /**
     * show a specific user information
     */
    public function show($id){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        $user = $this->userRepository->getSpecificedItem($id);
        return view('admin.pages.user.show',[
            'user' => $user
        ]);
    }

    /**
     * show a edit form of  a specific user
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('user.edit')){
            abort(403,'Unauthorized access');
        }
        $user = $this->userRepository->getSpecificedItem($id);
        return view('admin.pages.user.edit',[
            'user' => $user,
        ]);
    }

    /**
     * update a specefied user information
     */
    public function update(UserUpdateRequest $request,$id){
        if(is_null($this->user) || !$this->user->can('user.edit')){
            abort(403,'Unauthorized access');
        }
        $this->userRepository->update($request,$id);
        return back()->with('user_update_success','User Update Successfully');
    }

    /**
     * delete a specefic user
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('user.destroy')){
            abort(403,'Unauthorized access');
        }
        $this->userRepository->delete($id);
        return back()->with('user_delete_success','User Delete Successfully');
    }

    /**
     * get all country information by name
     *
     * @param $countryName
     */
    public function getCountryInformation($countryName){
        $countryInfo =  Country::getCountryInformation($countryName);
        $success = false;
        if($countryInfo){
            $success = true;
        }
        return json_encode([
            'success'=> $success,
            'countryInfo'=>$countryInfo
        ]);
    }
}
