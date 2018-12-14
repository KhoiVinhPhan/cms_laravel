<?php

namespace Core\Repositories;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\CategoryArticle;
use App\Models\Articles;

class ArticleRepository implements ArticleRepositoryContract
{
    //get data category articles
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

    //create articles
    public function store($input)
    {
        //echo "<pre>";print_r($input['status']);exit;
        DB::beginTransaction();
        try{
            $data = array(
                'title'         => $input['title'],
                'description'   => $input['description'],
                'details'       => $input['details'],
                'status'        => (!empty($input['status'])) ? 1 : 0,
                'avatar'        => $input['avatar'],
                'user_id_maked' => Auth::user()->user_id
            );
            Articles::create($data);
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    //change status article
    public function changeStatus($input)
    {
        DB::beginTransaction();
        try{
            DB::table('articles')
                ->where('article_id', '=', $input['data']['article_id'])
                ->update([
                    'status' => $input['data']['status'],
                    'user_id_updated' => Auth::user()->user_id,
                    'updated_at' => now()
                ]);
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    // all data articles
    public function allArticle($request)
    {
        $totalData = Articles::count();
        $totalFiltered = $totalData; 
        $columns = array(
                            0 => 'article_id',
                            1 => 'avatar',
                            2 => 'title',
                            3 => 'status',
                            4 => 'article_id',
                        );
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {            
            $posts = Articles::offset($start)
                        ->limit($limit)
                        ->where('user_id_maked', '=', Auth::user()->user_id)
                        ->orderBy($order,$dir)
                        ->get();
        } else {
            $search = $request->input('search.value'); 

            $posts = Articles::where('title', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->where('user_id_maked', '=', Auth::user()->user_id)
                        ->orderBy($order,$dir)
                        ->get();

            $totalFiltered = Articles::where('title', 'LIKE',"%{$search}%")
                                ->where('user_id_maked', '=', Auth::user()->user_id)
                                ->count();
        }

        $data = array();
        if (!empty($posts)) {
            $stt = 0;
            foreach ($posts as $post) {
                $stt++;

                //kiem tra avatar
                if (empty($post->avatar)) {
                    $avatar = '/image_default/logo.png';
                } else {
                    $avatar = $post->avatar;
                }

                //kiem tra status
                if ($post->status == 1) {
                    $status = 'checked';
                } else {
                    $status = '';
                }

                $arr['stt'] = $stt;
                $arr['avatar'] = '<img src="'.$avatar.'" width="100px" height="70px">';
                $arr['title'] = $post->title.'<br>'.date('d-m-Y', strtotime($post->created_at));
                $arr['status'] = '
                        <label class="switch">
                            <input type="checkbox" '.$status.' onclick="changeStatus('.$post->article_id.')" id="status'.$post->article_id.'">
                            <span class="slider round"></span>
                        </label>';
                $arr['options'] = '<input type="button" class="btn btn-info btn block btn-flat btn-sm btn-block" value="chi tiet">';
                $data[] = $arr;
            }
        }

        $json_data = array(
                        "draw"            => intval($request->input('draw')),  
                        "recordsTotal"    => intval($totalData), 
                        "recordsFiltered" => intval($totalData), 
                        "data"            => $data
                    );
        echo json_encode($json_data);
    }

}