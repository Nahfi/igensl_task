<?php
namespace App\Repositories\User;

use App\Models\Application;
use App\Models\ApplicationFormElement;
use App\Models\User;
use App\Notifications\User\UserNotification;
use App\Services\FileService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Notification;


class ApplicationRepository{

    /**
     * constact a method
     */
    public $fileService;
    const imageLocation = "photo/applications/";
    const fileLocation = "file/applications/";
    public function __construct()
    {
        $this->fileService =  new FileService();
    }
    /**
     * create a new user
     *
     * @param object $request
     *
     */
    public function create($request){
        $userName = rand(100000,9999999);
        $password = Str::random(10);
        $user = new User();
        $user->name = $userName;
        $user->user_role_id = 1;
        if(ApplicationFormElement::getAllActiveElement()->where('input_type','email')->pluck('input_name')->toArray()){
            $requestField = (ApplicationFormElement::getAllActiveElement()->where('input_type','email')->pluck('input_name')->toArray()[0]);
            $user->email = $request->$requestField;
        }
        if(ApplicationFormElement::getAllActiveElement()->where('input_type','select')->where('is_country','1')->pluck('input_name')->toArray()){
            $requestField = (ApplicationFormElement::getAllActiveElement()->where('input_type','select')->where('is_country','1')->pluck('input_name')->toArray()[0]);
            $user->country = $request->$requestField;
        }
        if(ApplicationFormElement::getAllActiveElement()->where('input_type','number')->where('is_mobile','1')->pluck('input_name')->toArray()){
            $requestField = ApplicationFormElement::getAllActiveElement()->where('input_type','number')->where('is_mobile','1')->pluck('input_name')->toArray()[0];
            $user->phone = '+('.(explode(',', request()->countryCode))[1].')'.$request->$requestField;
        }

        $user->password = Hash::make($password);
        $user->email_verified_at = Carbon::now();
        $user->save();
        $this->sendMailNotification($user,$password);
        return $user->id;

    }
    /**
     * send a email notification to user
     */
    public function sendMailNotification($user,$password){
        $userInfo = [
            'greeting' => 'Hi Dear,',
            'body' => 'Here is Your Login Credential
            Your User Name is - "'.$user->name. '" And Your Password is - "'.$password .'" You Can Login Using These Credentital After Your Application Apporoved. We will Notify you After Apporved ',
            'thanks' => 'Thank you this is from task',
            'actionText' => 'login',
            'actionURL' => url('/login'),
        ];

        Notification::send($user, new UserNotification($userInfo));
    }

    /**
     * create a new applications
     *
     * @param $request ,$user_id
     */
    public function createApplication($userId,$request ){

        $application = new Application();
        $application->user_id =  $userId;
        $applicationData = [];
        foreach($request->all() as $key=>$value){
            if($key !='_token'){

                if($key =='countryCode'){
                    $applicationData[$key] = (explode(',', request()->countryCode))[1];
                }
                else{
                    if($key =='file'){
                        $applicationData[$key] = $this->processFile($request->file('file'));
                    }
                    else{
                        $applicationData[$key] = $value;
                    }
                }

            }

        }
        $application->json_data = json_encode($applicationData);
        $application->save();

    }

    /**
     * process multiple files
     */
    public function processFile($files){

            $resourcesName = [];
            foreach($files as $resource){
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
            return json_encode($resourcesName);

    }
}
