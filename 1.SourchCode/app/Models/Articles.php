<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Articles extends Model
{
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }

    public $table = 'articles';

    protected $primaryKey = 'article_id';
    
    protected $fillable = [
        'title',
        'slug',
        'description',
        'details',
        'status',
        'avatar',
        'user_id_maked', 
        'user_id_deleted', 
        'user_id_updated', 
    ];
}