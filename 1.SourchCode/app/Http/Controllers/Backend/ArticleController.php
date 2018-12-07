<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Services\ArticleServiceContract;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;
use App\Models\CategoryArticle;
use App\Models\Articles;

class ArticleController extends Controller
{
	protected $articleService;

	public function __construct(ArticleServiceContract $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index()
    {
        return view('backend.article.index');
    }

    public function create()
    {
        return view('backend.article.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        echo "<pre>";print_r($input);exit;
    }

    public function category()
    {
        $categorys = $this->articleService->category();
        // $data = array();
        // $abc = $this->menuParrent($data, 0, 0);
        // echo "<pre>";print_r($abc);exit;
        return view('backend.article.category', compact('categorys'));
    }

    public function menuParrent($data, $parent, $level)
    {
        // $arr = [];
        $record = DB::table('category_article')->select('*')->where('parrent_id', '=', 0)->get();
        foreach ($record as $key => $value) {
            // if ($value->parrent_id == $parent) {
                $data[count($data)] = $record[$key];
                $data[$key]->level = $level;
                // $this->menuParrent($data, $value->category_article_id, $level+1);
            // }
        }
        return $data;
    }

    public function createCategory()
    {
        $categorys = $this->articleService->category();
        return view('backend.article.create-category', compact('categorys'));
    }

    public function storeCategory(Request $request)
    {
        $input = $request->all();
        if($this->articleService->storeCategory($input)){
            Session::flash('success', 'Thêm danh mục thành công');
            return redirect()->route('categoryArticle');
        }else{
            Session::flash('error', 'Thêm danh mục không thành công');
            return redirect()->route('createCategory');
        }
    }

    public function editCategory($id)
    {
        $category = CategoryArticle::find($id);
        $categorys = $this->articleService->category();
        return view('backend.article.edit-category', compact('categorys', 'category'));
    }

    public function updateCategory(Request $request)
    {
        $input = $request->all();
        if($this->articleService->updateCategory($input)){
            Session::flash('success', 'Cập nhật danh mục thành công');
            return redirect()->route('categoryArticle');
        }else{
            Session::flash('error', 'Cập nhật danh mục không thành công');
            return redirect()->route('categoryArticle');
        }
    }

    public function allArticle(Request $request)
    {
        $input = $request->all();

        $totalData = Articles::count();
        $totalFiltered = $totalData; 
        // echo "<pre>";print_r($input);exit;
        $columns = array( 
                            0 => 'article_id', 
                            1 => 'title',
                            2 => 'slug',
                            3 => 'description',
                            4 => 'article_id',
                            5 => 'article_id',
                        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        // echo "<pre>";print_r($dir);exit;

        if(empty($request->input('search.value')))
        {            
            $posts = Articles::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $posts =  Articles::where('article_id','LIKE',"%{$search}%")
                            ->orWhere('title', 'LIKE',"%{$search}%")
                            ->orWhere('slug', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Articles::where('article_id','LIKE',"%{$search}%")
                             ->orWhere('title', 'LIKE',"%{$search}%")
                             ->orWhere('slug', 'LIKE',"%{$search}%")
                             ->count();
        }


        $data = array();
        if(!empty($posts))
        {
            $stt = 0;
            foreach ($posts as $post)
            {
                $stt++;
                $arr['article_id'] = $post->article_id;
                $arr['title'] = $post->title;
                $arr['slug'] = $post->slug;
                $arr['description'] = $post->description;
                $arr['options'] = "<input type='button' class='btn btn-info btn block btn-flat' value='chi tiet'>";
                $arr['stt'] = $stt;
                
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