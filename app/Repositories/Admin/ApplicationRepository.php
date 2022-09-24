<?php
namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Models\Application;
use App\Models\Feedback;
use App\Services\FileService;
use App\Notifications\User\UserNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Notification;
class ApplicationRepository{

    /**
     * constact a method
     */
    public $fileService;
    const imageLocation = "photo/applications/feedback/";
    const fileLocation = "file/applications/feedback/";
    public function __construct()
    {
        $this->fileService =  new FileService();
    }

    /**
     * get all applications
     */
    public function index(){
        return Application::with(['user','feedback','feedback.feedbackedBy'])->latest()->get();
    }

    /**
     * update a specific applications
     *
     * @param int id
     */
    public function update($request,$id){
        $application =  Application::getSpecificedApplication($id);
        $application->status = $request->status;
        $application->save();
        // accept,received,declined
        if( $request->status == 'received'){
            if($application->user->status == 'DeActive')
            {
                $application->user->status ='Active';
                $application->user->save();
                $body = 'Dear We Recived Your Application Now You Can Login . After Approved You Can See Application Information';
                $this->sendMailNotification($application,$body);
            }

        }
        else if( $request->status == 'declined'){
            $body = 'Dear We declined Your Application ';
            $this->sendMailNotification($application,$body);
        }
        else if( $request->status == 'accept'){
            $body = 'Dear We Accept Your Application Now You Can  See Application Information';
            $this->sendMailNotification($application,$body);
        }




    }

    /**
     * send a email notification to user
     */
    public function sendMailNotification($application,$body){
        $userInfo = [
            'greeting' => 'Hi Dear,',
            'body' => $body,
            'thanks' => 'Thank you this is from'.generalSettings()->name,
            'actionText' => 'login',
            'actionURL' => url('/login'),
        ];

        Notification::send($application->user, new UserNotification($userInfo));
    }
    /**
     * destroy a specific applications
     *
     * @param int id
     */
    public function delete($id){

        $application =  Application::getSpecificedApplication($id);
        $body = 'Dear Your Login Account And Application Deleted.';
        $this->sendMailNotification($application,$body);
        $application->user->delete();
        $application->delete();
    }
    /**
     * find application by status
     *
     * @param $request
     */
    public function applicationFindByStatus($status){
        if($status ==  'all'){
            $applications = $this->index();
        }
        else{
            $applications = Application::with(['user','feedback','feedback.feedbackedBy'])->where('status',$status)->get();
        }
        return $applications;

    }

    /**
     * create feedback
     */
    public function createFeedback($request,$applicationId){
  
        $feedback =  new Feedback();
        $feedback->application_id = $applicationId;
        $feedback->comment = $request->comment;
        if($request->hasFile('file')){
            $resources = $request->file('file');
            $resourcesName = [];
            foreach($resources as $resource){
                $file = $resource->getClientOriginalName();
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $new_name = rand(100,999).$fileName.'.'.$resource->getClientOriginalExtension();
                if($resource->getClientOriginalExtension() == 'pdf'){
                    $resourcesName[]  =  $this->fileService->upload($new_name,ApplicationRepository::fileLocation,$resource);
                }
                else{
                    $resourcesName[]  =  $this->fileService->upload($new_name,ApplicationRepository::imageLocation,$resource);
                }
            }
            $feedback->file = json_encode($resourcesName);
        }
        $feedback->feedbacked_by = Auth::guard('admin')->user()->id;
        $feedback->save();
       
    }

}
