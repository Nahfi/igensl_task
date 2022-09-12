<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * define relation with feedback
     */
    public function feedbackedBy()
    {
        return $this->belongsTo(Admin::class,'feedbacked_by','id');
    }
}