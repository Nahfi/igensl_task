<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public $user ;
    public function __construct(){

        $this->middleware(function($request,$next){
            $this->user = Auth::guard('web')->User();
            return $next($request);
        });

    }

    /**
     * Show the user dashboard
     */
     public function index(){

        if(is_null($this->user)){
            abort(403,'Unauthorized access');
        }
        else{
            if(!in_array('application.view',Auth::guard('web')->user()->userRole->userPermissions->pluck('name')->toArray())){
                return view('user.pages.home.index',[
                    'application'=>'none'
                ]);
            }
            else{
                return view('user.pages.home.index',[
                    'application'=>Auth::guard('web')->user()->application->first()
                ]);
            }
        }

     }

}
