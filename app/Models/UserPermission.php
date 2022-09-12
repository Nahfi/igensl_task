<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use HasFactory;


    /**
     * role permission  realtionship
     */
    public function userRoles(){
        return $this->belongsToMany(UserRole::class, 'user_role_permissions', 'user_role_id', 'user_permission_id');
    }
}
