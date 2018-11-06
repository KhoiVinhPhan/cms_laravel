<?php

namespace Core\Repositories;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\SystemPagination;

class ArticleRepository implements ArticleRepositoryContract
{
    public function category()
    {
        $categorys = DB::table('category_article')->select('*')->get()->toArray();
        return $categorys;
    }

}