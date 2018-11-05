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

    public function category()
    {
        $data = \DB::table('category_article')->select('*')->get()->toArray();
        
        $arrParrent = array();
        foreach ($data as $key => $value) {

            if($value->parrent_id == 0){
                 $arrParrent[] = array(
                                    'category_article_id'    => $value->category_article_id,
                                    'name'       => $value->name,
                                    'parrent_id'    => $value->parrent_id,
                                );
            }
           
        }

        echo "<pre>";print_r($arrParrent);exit;
    }

    
}