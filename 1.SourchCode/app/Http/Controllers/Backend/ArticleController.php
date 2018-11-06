<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Services\ArticleServiceContract;
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
        $categorys = $this->articleService->category();
        // echo "<pre>";print_r($categorys);exit;
        return view('backend.article.category', compact('categorys'));
        
    }
    
}