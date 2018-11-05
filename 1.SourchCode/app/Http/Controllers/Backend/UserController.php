<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Core\Services\UserServiceContract;
use Session;
use App\Models\UserPermission;
use Auth;
use Config;

class UserController extends Controller
{
	protected $userService;

	public function __construct(UserServiceContract $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        if ($request->searchUser == "") {
            //data not search
            $users = $this->userService->getUsers();
            $permissions = UserPermission::All();
            return view('backend.users.index', compact('users', 'permissions'));
        } else {
            //data search
            $input = $request->all();
            $users = $this->userService->search($input);
            $users->appends($request->only('searchUser'));
            $permissions = UserPermission::All();
            $searchUser = $input['searchUser'];
            return view('backend.users.index', compact('users', 'permissions', 'searchUser'));
        }
    	
    }

    public function profile()
    {
        $profile = $this->userService->profile();
        return view('backend.users.profile', compact('profile'));
    }

    public function changePasswordLogin(Request $request)
    {
        $input = $request->all();
        if($this->userService->changePasswordLogin($input)) {
            return "success";
        }else {
            return "error";
        }
    }

    public function update(Request $request)
    {
        $input = $request->all();
        if($this->userService->update($input)){
            return "success";
        }else{
            return "error";
        }
    }

    public function editProfileIsAdmin(Request $request)
    {
        $input = $request->all();
        if($this->userService->editProfileIsAdmin($input)){
            return "success";
        }else{
            return "error";
        }
    }

    public function getDataUserInModal(Request $request)
    {
        $input = $request->all();
        if($profile = $this->userService->getDataUserInModal($input)){
            return $profile;
        }else{
            return "error";
        }
    }

    public function changePassword(Request $request)
    {
        $input = $request->all();
        if($this->userService->changePassword($input)){
            return "success";
        }else{
            return "error";
        }
    }

    public function create()
    {
        $permissions = UserPermission::All();
        return view('backend.users.create', compact('permissions'));
    }

    public function checkEmail(Request $request)
    {
        $input = $request->all();
        if($this->userService->checkEmail($input)){
            return "success";
        }else{
            return "error";
        }
    }

    public function store(Request $request)
    {   
        $input = $request->all();
        if($this->userService->store($input)){
            Session::flash('success', 'Thêm user thành công');
            return redirect()->route('indexUsers');
        }else{
            Session::flash('error', 'Thêm user thành công');
            return redirect()->route('indexUsers');
        }
    }

    public function delete(Request $request)
    {
        $input = $request->all();
        if($this->userService->delete($input)) {
            Session::flash('success', 'Khóa user thành công');
            return redirect()->route('indexUsers');
        }else {
            Session::flash('warning', 'Bạn phải chọn user để xóa');
            return redirect()->route('indexUsers');
        }
    }

    public function restore(Request $request)
    {
        if ($request->searchUser == "") {
            //data not search
            $users = $this->userService->getUserRestore();
            $permissions = UserPermission::All();
            return view('backend.users.restore', compact('users', 'permissions'));
        } else {
            //data search
            $input = $request->all();
            $users = $this->userService->searchUserRestore($input);
            $users->appends($request->only('searchUser'));
            $permissions = UserPermission::All();
            $searchUser = $input['searchUser'];
            return view('backend.users.restore', compact('users', 'permissions', 'searchUser'));
        }
    }

    public function restoreUsers(Request $request)
    {
        $input = $request->all();
        if($this->userService->restoreUsers($input)) {
            Session::flash('success', 'Khôi phục user thành công');
            return redirect()->route('restoreUser');
        }else {
            Session::flash('warning', 'Bạn phải chọn user để khôi phục');
            return redirect()->route('restoreUser');
        }
    }
   
}
