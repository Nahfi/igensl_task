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
        $password = rand(100000000,999999999);
        $userName = Str::random(10);
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
        // $this->sendMailNotification($request->fname.' '.$request->fname,$user,$password);
        return $user->id;

    }
    /**
     * send a email notification to user
     */
    public function sendMailNotification($name,$user,$password){
        $userInfo = [
            'greeting' => 'Hi '.$name.',',
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
        $clinet = [];
        foreach($request->all() as $key=>$value){
            if($key !='_token'){
                $clinet[$key] =$value;
            }


        }
        dd($clinet);

        // dd(json_encode($request->all()));
        // $application->first_name = $request->fname;
        // $application->last_name = $request->lname;
        // $application->previous_degree = $request->previousDegree;
        // $application->email = $request->email;
        // $application->country = $request->country;
        // $application->phone = '+('.(explode(',', request()->countryCode))[1].')'.$request->phone;
        // $application->program = $request->program;
        // $application->message = $request->message;
        // $application->date_of_birth = $request->dob;
        // $x=setting::find(1);

        // if($r->hasFile('pic')){


        //     $loc='/upload/client/';
        //     $client_img=$r->file('pic');
        //     foreach($client_img as $s){

        //         $name='client_'.rand().".".$s->getClientOriginalExtension();




        //         $s->move(public_path().$loc,$name);
        //         $p[]=  ($loc.$name);
        //         $all_image=(json_encode($p));

        //     }
        // }
        // else{

        //     $all_image=(json_encode($r->prev));

        // }

        // $clinet=[

        //    "test1"=>$r->header,
        //    "test2"=>$r->header_1,
        //    "image"=>$all_image

        // ];

        // $x->client=json_encode($clinet);
        // $x->update();


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
            // $application->file = json_encode($resourcesName);
        }
        // dd($application->all());
        // $application->save();

    }
}