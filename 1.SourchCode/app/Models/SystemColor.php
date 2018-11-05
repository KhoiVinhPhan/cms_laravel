<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemColor extends Model
{
    public $table = 'system_color';

    protected $primaryKey = 'color_id';
    
    protected $fillable = [
        'color_menu_top',
        'color_logo',
        'sidebar',
        'user_id', 
        'user_id_maked', 
        'user_id_deleted', 
        'user_id_updated', 
    ];
}