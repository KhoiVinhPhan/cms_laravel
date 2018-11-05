<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Services\SystemServiceContract;
use Auth;
use Session;

class ArticleController extends Controller
{
	protected $systemService;

	public function __construct(SystemServiceContract $systemService)
    {
        $this->systemService = $systemService;
    }

    public function index()
    {
        return view('backend.article.index');
    }

    public function create()
    {
        return view('backend.article.create');
    }

    
}