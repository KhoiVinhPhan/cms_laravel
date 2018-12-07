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
        DB::beginTransaction();
        try{
            $data = array(
                'title'         => $input['title'],
                'description'   => $input['description'],
                'details'       => $input['details'],
                'status'        => (empty($input['status'])) ? 1 : 0,
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
                        ->orderBy($order,$dir)
                        ->get();
        } else {
            $search = $request->input('search.value'); 

            $posts =  Articles::where('article_id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Articles::where('article_id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->count();
        }

        $data = array();
        if (!empty($posts)) {
            $stt = 0;
            foreach ($posts as $post) {
                $stt++;
                if (empty($post->avatar)) {
                    $avatar = '/image_default/logo.png';
                } else {
                    $avatar = $post->avatar;
                }

                $arr['stt'] = $stt;
                $arr['avatar'] = '<img src="'.$avatar.'" width="100px" height="70px">';
                $arr['title'] = $post->title;
                $arr['status'] = "<input type='checkbox' checked data-toggle='toggle' data-on='Công khai' data-off='Lưu nháp' data-onstyle='success' data-offstyle='default' data-size='small' name='status'>";
                $arr['options'] = '<input type="button" class="btn btn-info btn block btn-flat btn-sm" value="chi tiet">';
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