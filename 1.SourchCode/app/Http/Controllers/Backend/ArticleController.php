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
        $categorys = $this->articleService->category();
        return view('backend.article.create', compact('categorys'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        echo "<pre>";print_r($input);exit;
        if($this->articleService->store($input)){
            Session::flash('success', 'Thêm bài viết thành công');
            return redirect()->route('indexArticle');
        }else{
            Session::flash('error', 'Thêm bài viết không thành công');
            return redirect()->route('createArticle');
        }
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
        $data = $this->articleService->allArticle($request);
        echo $data;
    }

    public function changeStatus(Request $request)
    {
        $input = $request->all();
        if ($this->articleService->changeStatus($input)) {
            return "success";
        } else {
            return "error";
        }
    }
    
}