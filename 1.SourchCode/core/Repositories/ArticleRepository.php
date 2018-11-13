<?php

namespace Core\Repositories;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\CategoryArticle;

class ArticleRepository implements ArticleRepositoryContract
{
    public function category()
    {
        $categorys = DB::table('category_article')->select('*')->get()->toArray();
        return $categorys;
    }

    //create category
    public function storeCategory($input)
    {
        DB::beginTransaction();
        try{
            $data = array(
                'name'          => $input['category'],
                'description'   => $input['description'],
                'parrent_id'    => $input['category_parrent'],
                'user_id_maked' => Auth::user()->user_id
            );
            CategoryArticle::create($data);
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }  
    }

    //update category
    public function updateCategory($input)
    {
        DB::beginTransaction();
        try{
            $data = array(
                'name'          => $input['category'],
                'description'   => $input['description'],
                'parrent_id'    => $input['category_parrent'],
                'user_id_maked' => Auth::user()->user_id
            );
            CategoryArticle::find($input['category_article_id'])->update($data);
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

}