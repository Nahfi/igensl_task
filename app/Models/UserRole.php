<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;
    protected $guarded =[

    ];

    /**
     * role permission  realtionship
     */
    public function userPermissions(){
        return $this->belongsToMany(UserPermission::class, 'user_role_permissions', 'user_role_id', 'user_permission_id');
    }
}