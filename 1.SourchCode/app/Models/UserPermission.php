<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    use SoftDeletes;

    public $table = 'users_permission';

    protected $primaryKey = 'user_permission_id';
    
    protected $fillable = [
        'name_permission', 
        'detail_permission',
    ];
}