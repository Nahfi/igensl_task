<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Construct method
     */
    public $user;
    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
    }

    /**
     * Show the authenticated user profile
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('profile.edit')){
            abort(403,'Unauthorized access');
        }
        $admin = Admin::with('roles')->where('email',Auth::guard('admin')->User()->email)->first();
        return view('admin.pages.profile.index',[
            'admin' => $admin
        ]);
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request){

        if(is_null($this->user) || !$this->user->can('profile.passwordChange')){
            abort(403,'Unauthorized access');
        }
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);


        if (Hash::check($request->old_password,Auth::guard('admin')->User()->password)) {

            $id = Auth::guard('admin')->User()->id;
            Admin::where('id',Auth::guard('admin')->User()->id)->update([
                'password' => Hash::make($request->password)
            ]);

            Auth::guard('admin')->loginUsingId($id);

            return back()->with('password_changed','Password Updated successfully');
         }

         return back()->with('password_not_match','Password does not match with previous Password');
    }


    /**
     * Update Genearl Information
     */
    public function update(Request $request){
        if(is_null($this->user) || !$this->user->can('profile.update')){
            abort(403,'Unauthorized access');
        }
        $admin = Admin::where('email',Auth::guard('admin')->User()->email)->first();
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:admins,email,'.$admin->id,
        ]);
        $imageService = new FileService();
        $imageName = $admin->photo;
        $imageLocation = 'photo/profile/';
        if($request->hasFile('photo')){
            if($imageName != 'default_profile.jpg'){
                $imageService->delete($imageName,$imageLocation);
            }
            $newName = rand(100,999).$admin->name.'.'.$request->file('photo')->getClientOriginalExtension();
            $imageName = $imageService->upload($newName,$imageLocation,$request->file('photo'));
        }
        Admin::where('email',$admin->email)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $imageName,
        ]);

       return back()->with('profile_updated',"Profile Update Successfully");
    }
}