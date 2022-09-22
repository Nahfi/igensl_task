<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeedBackStoreRequest;
use App\Models\Application;
use App\Models\ApplicationFormElement;
use App\Repositories\Admin\ApplicationRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminApplicationController extends Controller
{

    /**
     * construct a method
     */
    const fileLocation = "/file/applications/";
    const feedbackFileLocation = "/file/applications/feedback/";
    public $user,$applicationRepository;
    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * get all application inforamtion
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.application.index',[
            'applications' => $this->applicationRepository->index(),
            'inputLabels'=>ApplicationFormElement::getAllActiveElement()
        ]);
    }

    /**
     * update applications status
     */
    public function update(Request $request,$id){
        if(is_null($this->user) || !$this->user->can('user.edit')){
            abort(403,'Unauthorized access');
        }

        $request->validate([
            'status'=>'required|in:accept,received,declined'
        ]);
        $this->applicationRepository->update($request,$id);
        return back()->with('application_update_success','Application Update Successfully');
    }

    /**
     * show a specific application
     */
    public function show($id){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        $application = Application::getSpecificedApplication($id);
        return view('admin.pages.application.show',[
            'application' => $application
        ]);
    }

    /**
     * delete a specefic Application
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('user.destroy')){
            abort(403,'Unauthorized access');
        }
        $this->applicationRepository->delete($id);
        return back()->with('application_delete_success','Application Delete Successfully');
    }

    /**
     * download a specific pdf file
     */
    public function download($name){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        $filepath = public_path(AdminApplicationController::fileLocation.$name);
        return Response()->download($filepath);
    }
    /**
     * download a specific feedback pdf file
     */
    public function feedbackDownload($name){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        $filepath = public_path(AdminApplicationController::feedbackFileLocation.$name);
        return Response()->download($filepath);
    }

    /**
     * show feed-back form
     */
    public function feedback($id){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.application.feedback',[
            'id' => $id
        ]);
    }

    /**
     * store a feed-back
     */
    public function feedbackStore(FeedBackStoreRequest $request,$id){
        if(is_null($this->user) || !$this->user->can('user.index')){
            abort(403,'Unauthorized access');
        }
        $this->applicationRepository->createFeedback( $request,$id);
        return back()->with('feedback_store_success','FeedBack Store Successfully');
    }


}
