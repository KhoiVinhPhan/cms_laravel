<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Services\ArticleServiceContract;
use Illuminate\Support\Facades\DB;
use Auth;
use Session;

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
        $categorys = DB::table('category_article')->select('*')->get()->toArray();
        $categorys = $this->articleService->category();
        return view('backend.article.category', compact('categorys'));
        
    }
    
}