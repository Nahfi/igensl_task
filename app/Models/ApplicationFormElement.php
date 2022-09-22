<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationFormElement extends Model
{
    use HasFactory;

    /**
     * get all active form element orderby priority
     */
     public static function getAllActiveElement(){
        return ApplicationFormElement::where('status','Active')->orderBy('priority_id', 'ASC')->get();
     }

    /**
     * get element by priority
     */
     public static function inputElementByPriority($priorityNumber){
        return ApplicationFormElement::where('priority_id',$priorityNumber)->count();
     }
}
