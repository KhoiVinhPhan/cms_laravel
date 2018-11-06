<?php

namespace Core\Repositories;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\SystemPagination;

class ArticleRepository implements ArticleRepositoryContract
{
    public function category()
    {
        $data = DB::table('category_article')->select('*')->get()->toArray();
        $arrCategory = array();
        foreach ($data as $key => $value) {
            if($value->parrent_id == 0){
                $arrCategory[] = array(
                                    'category_article_id' => $value->category_article_id,
                                    'name'                => $value->name,
                                    'parrent_id'          => $this->subCategory($data, $value->category_article_id, $value->parrent_id),
                                );
            }
           
        }
        return $arrCategory;
    }

    public function subCategory($data, $category_article_id ,$parrent_id)
    {
        $arrSubCategory = array();
        foreach ($data as $key => $item) {
            if($item->parrent_id == $category_article_id){
                 $arrSubCategory[] = array(
                                    'category_article_id' => $item->category_article_id,
                                    'name'                => $item->name,
                                    'parrent_id'          => $this->subCategory($data, $item->category_article_id, $item->parrent_id),
                                );
            }
        }
        return $arrSubCategory;
    }
}