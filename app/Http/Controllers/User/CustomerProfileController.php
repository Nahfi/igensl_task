<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class CustomerProfileController extends Controller
{
    /**
     * construct a method
     */
    public $user;
    public function __construct()
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('web')->User();
            return $next($request);
        });
    }

    /**
     * Show the authenticated user profile
     */
    public function index(){
        if(is_null($this->user)){
            abort(403,'Unauthorized access');
        }
        $user = User::where('email',Auth::guard('web')->User()->email)->first();
        return view('user.pages.profile.index',[
            'user' => $user
        ]);
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request){
        if(is_null($this->user)){
            abort(403,'Unauthorized access');
        }
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $id = Auth::guard('web')->User()->id;

        if (Hash::check($request->old_password,Auth::guard('web')->User()->password)) {
            User::where('id',Auth::guard('web')->User()->id)->update([
                'password' => Hash::make($request->password),
             ]);
            Auth::loginUsingId($id);

             return back()->with('password_changed','Password Change Successfully');
         }

         return back()->with('password_not_match','Password does not match with previous Password');
    }


    /**
     * Update Genearl Information
     */
    public function update(Request $request){

        if(is_null($this->user)){
            abort(403,'Unauthorized access');
        }
        $user = User::where('email',Auth::guard('web')->User()->email)->first();

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,
        ]);
        $imageService = new FileService();

        $imageName = $user->photo;
        $imageLocation = 'photo/user_profile/';
        if($request->hasFile('photo')){
            if($imageName != 'default.jpg'){
                $imageService->delete($imageName,$imageLocation);
            }
            $newName = rand(100,999).$user->name.'.'.$request->file('photo')->getClientOriginalExtension();
            $imageName = $imageService->upload($newName,$imageLocation,$request->file('photo'));
        }
        User::where('email',$user->email)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $imageName,
        ]);

       return back()->with('profile_updated',"Profile Update Successfully");
    }

}