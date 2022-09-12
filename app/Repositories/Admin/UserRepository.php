<?php
namespace App\Repositories\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class UserRepository{


    /**
     * get all user
     */
    public function index(){
        return User::with(['createdBy','editedBy','application'])->latest()->get();
    }

    /**
     * get specefic user
     *
     * @param int $id
     *
     */
    public function getSpecificedItem($id){
        return User::with(['createdBy','editedBy'])->where('id',$id)->first();
    }

    /**
     * create a new user
     *
     * @param object $request
     *
     */
    public function create($request){
        $user = new User();
        $user->status = $request->status;
        $user->user_role_id = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->country = $request->country;
        $user->phone = '+('.(explode(',', request()->countryCode))[1].')'.$request->phone;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->email_verified_at = Carbon::now();
        $user->created_by = Auth::guard('admin')->User()->id;
        $user->save();
    }

    /**
     * update a specific user information
     *
     * @param $request,id
     *
     */
    public function update($request,$id){
        $user = $this->getSpecificedItem($id);
        $user->status = $request->status;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->edited_by = Auth::guard('admin')->User()->id;
        $user->save();
    }

    /**
     * destroy a specific user
     *
     * @param int id
     */
    public function delete($id){
        $item =  $this->getSpecificedItem($id);
        $item->delete();
    }

}
