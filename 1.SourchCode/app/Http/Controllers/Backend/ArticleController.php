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
        $category_articles = \DB::table('category_article')
                ->select('category_article_id', 'name', 'parrent_id')
                ->get();
                // echo "<pre>";print_r($category_articles);exit;

        $arrParrent = array();
        foreach ($category_articles as $key => $value) {
            if($value->parrent_id == 0){
                $arrParrent[$value->category_article_id] = $value->name;

                foreach ($arrParrent as $key => $item) {
                    if($value->parrent_id == $key){
                        
                    }
                }
                
            }     
        }
        echo "<pre>";print_r($arrParrent);exit;
        return view('backend.article.index', compact('category_articles'));
    }

    
}