<?php

namespace App\Models;

use illuminate\Database\Eloquent\Model;

class UserPermission extends Model 
{
    protected $table = 'users_permissions';

    protected $fillable = [
        'is_admin',
    ];

    public static $defaults = [
        'is_admin' => false,
    ];
    
}