<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemPagination extends Model
{
    public $table = 'system_pagination';

    protected $primaryKey = 'pagination_id';
    
    protected $fillable = [
        'pagination_backend', 
        'pagination_frontend', 
        'user_id', 
    ];
}