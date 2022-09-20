<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Repositories\Admin\AdminFormElementRepository;
class AdminApplicationFormController extends Controller
{
    /**
     * construct a method
     */
    public $user,$adminFormElementRepository;
    public function __construct(AdminFormElementRepository $adminFormElementRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->adminFormElementRepository = $adminFormElementRepository;
    }

    /**
     * get all application form inforamtion
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        // $applications = $this->adminFormElementRepository->index();
        return view('admin.pages.application_form.index');
    }
    /**
     * create a dynamic application
     */
    public function store(Request $request){
        // function clean($string) {
        //     $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        //     return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
        //  }
        // $test = stri
        dd($request->all());
        // if(is_null($this->user) || !$this->user->can('user.index')){
        //     abort(403,'Unauthorized access');
        // }
        // // $applications = $this->adminFormElementRepository->index();
        // return view('admin.pages.application_form.index');
    }

}
