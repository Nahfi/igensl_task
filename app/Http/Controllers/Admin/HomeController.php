<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\HomeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * show dashboard
     */
    public function index(){
        if(is_null($this->user)){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.home.index');
    }
}
