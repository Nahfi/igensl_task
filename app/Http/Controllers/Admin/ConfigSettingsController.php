<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;


class ConfigSettingsController extends Controller
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
     * Show Config Settings form
     */
    public  function configSettings(){
        if(is_null($this->user) || !$this->user->can('configSettings.index')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.settings.config_settings');
    }

    /**
     * optimize clear Settings update
     */
    public function optimizeClear(){
        if(is_null($this->user) || !$this->user->can('configSettings.optimizeClear')){
            abort(403,'Unauthorized access');
        }
        Artisan::call('optimize:clear');

        return back()->with('optimize_clear','Optimize Clear Successfully Done');
    }
    /**
     * Application optimize
     */
    public function optimize(){
        if(is_null($this->user) || !$this->user->can('configSettings.optimize')){
            abort(403,'Unauthorized access');
        }
        Artisan::call('optimize');

        return back()->with('optimize','Optimize Successfully Done');
    }

}