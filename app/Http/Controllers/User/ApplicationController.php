<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ApplicationStoreRequest;
use App\Http\Requests\User\ApplicationUpdateRequest;
use App\Models\Application;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Repositories\User\ApplicationRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use \Crypt;

class ApplicationController extends Controller
{
    /**
     * constract a method
     */
    const fileLocation = "/file/applications/";
    const feedbackFileLocation = "/file/applications/feedback/";
    public $user,$applicationRepository;
    public function __construct(ApplicationRepository $applicationRepository){

        $this->middleware(function($request,$next){
            $this->user = Auth::guard('web')->User();
            return $next($request);
        });
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * Store a newly created application in storage.
     */
    public function store(ApplicationStoreRequest $request)
    {

        $this->applicationRepository->createApplication($this->applicationRepository->create($request),$request);
        return redirect()->route('login')->with('message','Please Check Your Mail, We send You username and password theough mail, you can login after we apporove your application');
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

    /**
     * show a specific application
     */
    public function show($id){
        if(is_null($this->user) || !in_array('application.view',Auth::guard('web')->user()->userRole->userPermissions->pluck('name')->toArray())){
            abort(403,'Unauthorized access');
        }

        $parameter= Crypt::encrypt($id);
        $application = Application::getSpecificedApplicationForAuthUser($parameter);
        if($application){
            return view('user.pages.application.show',[
                'application' => $application
            ]);
        }
        else{
            abort(403,'Unauthorized access');
        }

    }


    /**
     * download a specific pdf file
     */
    public function download($name){
        $filepath = public_path(ApplicationController::fileLocation.$name);
        return Response()->download($filepath);
    }
    /**
     * download a specific feedback pdf file
     */
    public function feedbackDownload($name){
        $filepath = public_path(ApplicationController::feedbackFileLocation.$name);
        return Response()->download($filepath);
    }


}