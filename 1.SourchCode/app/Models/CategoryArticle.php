<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CategoryArticle extends Model
{
    use Sluggable;
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name',
            ]
        ];
    }

    public $table = 'category_article';

    protected $primaryKey = 'category_article_id';
    
    protected $fillable = [
        'name',
        'slug',
        'description',
        'parrent_id', 
        'user_id_maked', 
        'user_id_deleted', 
        'user_id_updated', 
    ];
}