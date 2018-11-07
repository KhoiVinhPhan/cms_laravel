<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Services\SystemServiceContract;
use App\Models\SystemPagination;
use App\Models\SystemColor;
use App\Models\SystemEditor;
use Auth;
use Session;

class SystemController extends Controller
{
	protected $systemService;

	public function __construct(SystemServiceContract $systemService)
    {
        $this->systemService = $systemService;
    }
    public function index()
    {
        $systemPagination = SystemPagination::where('user_id', Auth::user()->user_id)->first();
        $systemColor = SystemColor::where('user_id', Auth::user()->user_id)->first();
    	$systemEditor = SystemEditor::where('user_id', Auth::user()->user_id)->first();
        return view('backend.systems.index', compact('systemPagination', 'systemColor', 'systemEditor'));
    }

    //change pagination
    public function pagination(Request $request)
    {
    	$input = $request->all();
    	if($this->systemService->pagination($input)) {
            return "success";
        }else {
            return "error";
        }
    }

    //change color
    public function colors(Request $request)
    {
        $input = $request->all();
        if($this->systemService->colors($input)) {
            return "success";
        }else {
            return "error";
        }
    }

    //change language
    public function changeLanguage(Request $request)
    {
        $input = $request->all();
        if($this->systemService->changeLanguage($input)) {
            return "success";
        }else {
            return "error";
        }
    }

    //file manager
    public function imageManager()
    {
        return view('backend.systems.fileManager');
    }

    //change editor
    public function editor(Request $request)
    {
        $input = $request->all();
        if($this->systemService->editor($input)) {
            return "success";
        }else {
            return "error";
        }
    }
}