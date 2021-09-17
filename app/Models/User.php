<?php 

namespace App\Models;

use illuminate\Database\Eloquent\Model;

class User extends Model 
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'confirmation_key',
        'confirmation_expires'
    ];
}