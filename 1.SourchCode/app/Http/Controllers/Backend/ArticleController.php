<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Services\ArticleServiceContract;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;
use App\Models\CategoryArticle;

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

    public function category()
    {
        $categorys = $this->articleService->category();
        return view('backend.article.category', compact('categorys'));
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
    
}