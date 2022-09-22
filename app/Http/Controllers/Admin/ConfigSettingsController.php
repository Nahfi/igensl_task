<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminMailConfigRequest;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use App\Models\MailSetting;
use Illuminate\Http\Request;

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
        $mailSetting = MailSetting::getMailSetting();;
        return view('admin.pages.settings.config_settings',[
            'mailSetting'=>$mailSetting
        ]);
    }

    /**
     * update config mail setting
     */
    public  function configMailSetting(AdminMailConfigRequest $request){
        if(is_null($this->user) || !$this->user->can('configSettings.index')){
            abort(403,'Unauthorized access');
        }
        $mailsetting = MailSetting::updateMailSettings($request);
        Artisan::call('optimize:clear');
        return back()->with('mail_config','Mail Configaration Updated');
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
    }

}
