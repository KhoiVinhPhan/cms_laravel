<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemEditor extends Model
{
    public $table = 'system_editor';

    protected $primaryKey = 'editor_id';
    
    protected $fillable = [
        'name',
        'version_ckeditor',
        'user_id', 
        'user_id_maked', 
        'user_id_deleted', 
        'user_id_updated', 
    ];
}