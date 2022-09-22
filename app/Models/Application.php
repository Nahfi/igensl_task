<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\User\ApplicationRepository;
use App\Services\FileService;
use \Crypt;
use Illuminate\Support\Facades\Auth;

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
     * get auth user applications
     */
    public static function getSpecificedApplicationForAuthUser($param)
    {
    $data = Crypt::decrypt($param);
    return Application::with(['user','feedback','feedback.feedbackedBy'])->where('user_id', Auth::guard('web')->user()->id)->where('id', $data )->first();
}
    /**
     * get specefic applications
     *
     * @param int $id
     *
     */
    public static function updateApplication($request,$id){

    }

}
