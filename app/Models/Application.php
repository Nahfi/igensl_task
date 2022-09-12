<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\User\ApplicationRepository;
use App\Services\FileService;
class Application extends Model
{


    use HasFactory;
    protected $guarded =[

    ];


    /**
     * define relation with user
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * define relation with feedback
     */
    public function feedback()
    {
        return $this->hasMany(feedback::class,'application_id','id');
    }

    /**
     * get specefic applications
     *
     * @param int $id
     *
     */
    public static function getSpecificedApplication($id){
        return Application::with(['user','feedback','feedback.feedbackedBy'])->where('id',$id)->first();
    }
    /**
     * get specefic applications
     *
     * @param int $id
     *
     */
    public static function updateApplication($request,$id){

        $application = Application::getSpecificedApplication($id);
        $application->first_name =  $request->fname;
        $application->last_name =  $request->lname;
        $application->previous_degree =  $request->previousDegree;
        $application->email =  $request->email;
        $application->message =  $request->message;

        if($request->hasFile('file')){
            $fileService =  new FileService();
            $resources = $request->file('file');
            $resourcesName = [];
            foreach($resources as $resource){
                $file = $resource->getClientOriginalName();
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $new_name = rand(100,999).$fileName.'.'.$resource->getClientOriginalExtension();
                if($resource->getClientOriginalExtension() == 'pdf'){
                    $resourcesName[]  =  $fileService->upload($new_name,ApplicationRepository::fileLocation,$resource);
                }
                else{
                    $resourcesName[]  =  $fileService->upload($new_name,ApplicationRepository::imageLocation,$resource);
                }
            }
            $application->file = json_encode($resourcesName);
        }
        $application->save();
    }

}