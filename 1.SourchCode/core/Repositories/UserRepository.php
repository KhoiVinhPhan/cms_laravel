<?php

namespace Core\Repositories;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\User;
use App\Models\UserPhoto;
use App\Models\UserProfile;
use App\Models\SystemPagination;

class UserRepository implements UserRepositoryContract
{
    public function getUsers()
    {
        $pagination = SystemPagination::where('user_id', Auth::user()->user_id)->first();
        $users = DB::table('users')
                    ->select(
                        'users.*',
                        'users_permission.name_permission', 
                        'users_permission.detail_permission',
                        'user_photo.filename'
                    )
                    ->leftjoin('users_permission', 'users_permission.user_permission_id', '=', 'users.user_permission_id')
                    ->leftjoin('user_photo', 'user_photo.user_id', '=', 'users.user_id')
                    ->orderBy('users.user_id', 'desc')
                    ->whereNull('users.deleted_at') 
                    ->paginate(empty($pagination) ? 5 : $pagination['pagination_backend']);
        return $users;
    }

    public function getUserRestore()
    {
        $pagination = SystemPagination::where('user_id', Auth::user()->user_id)->first();
        $users = DB::table('users')
                    ->select(
                        'users.*',
                        'users_permission.name_permission', 
                        'users_permission.detail_permission',
                        'user_photo.filename'
                    )
                    ->leftjoin('users_permission', 'users_permission.user_permission_id', '=', 'users.user_permission_id')
                    ->leftjoin('user_photo', 'user_photo.user_id', '=', 'users.user_id')
                    ->orderBy('users.user_id', 'desc')
                    ->whereNotNull('users.deleted_at')
                    ->paginate(empty($pagination) ? 5 : $pagination['pagination_backend']);
        return $users;
    }

    public function changePasswordLogin($input)
    {
        $userLogin = DB::table('users')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
        if (password_verify($input['password_old'], $userLogin->password)) {
            DB::table('users')
                ->where('user_id', Auth::user()->user_id)
                ->update([
                    'password' => bcrypt($input['password_new']),
                ]);
            return true;
        } else {
            return false;
        }
    }

    //update user profile
    public function update($input)
    {
        DB::beginTransaction();
        try{
            //Update users
            DB::table('users')
                ->where('user_id', Auth::user()->user_id)
                ->update([
                    'name'  => $input['name']
                ]);

            //Update image
            if(!empty($input['image_user'])){
                $filename = uniqid() . "." . $input["image_user"]->getClientOriginalExtension();

                //Update users
                DB::table('users')
                    ->where('user_id', Auth::user()->user_id)
                    ->update([
                        'image'  => $filename
                    ]);

                $data = array(
                    'user_id'       => Auth::user()->user_id,
                    'type'          => '1',
                    'filename'      => $filename,
                    'filepath'      => config('constants.avatar_savedir'),
                    'size'          => $input["image_user"]->getSize(),
                    'mime'          => $input["image_user"]->getMimeType(),
                    'org_filename'  => $input["image_user"]->getClientOriginalName(),
                );

                $check_photo = DB::table('user_photo')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
                if(!empty($check_photo)){
                    //Delete dir image_user
                    $image_path = config('constants.avatar_savedir')."/".$check_photo->filename;
                    if(\File::exists($image_path)) {
                        \File::delete($image_path);
                    }
                    //Update image_user
                    UserPhoto::find($check_photo->user_photo_id)->update($data);
                    move_uploaded_file($_FILES['image_user']['tmp_name'], config('constants.avatar_savedir')."/".$filename);
                }else{
                    //Create image_user
                    UserPhoto::create($data);
                    move_uploaded_file($_FILES['image_user']['tmp_name'], config('constants.avatar_savedir')."/".$filename);
                }
            }

            //Check phoneUser
            $phoneUser = '';
            if (!empty($input['phoneUser'])) {
                foreach ($input['phoneUser'] as $key => $value) {
                    $phoneUser =  $phoneUser.$input['phoneUser'][$key].',';
                }
                $phoneUser = rtrim($phoneUser, ',');
            }

            //Check genderUser
            $genderUser = 0;
            if (!empty($input['gender'])) {
                $genderUser = $input['gender'];
            }

            $data_profile = array(
                'user_id'       => Auth::user()->user_id,
                'phone'         => $phoneUser,
                'address'       => $input['address'],
                'date'          => $input['date'],
                'month'         => $input['month'],
                'year'          => $input['year'],
                'gender'        => $genderUser,
                'information'   => $input['information'],
            );

            $check_profile = DB::table('user_profile')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
            if(!empty($check_profile)) {
                //Update profile
                UserProfile::find($check_profile->user_profile_id)->update($data_profile);
            }else{
                //Create profile
                UserProfile::create($data_profile);
            }

            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    //get data profile
    public function profile()
    {
        $profile = DB::table('users')
                    ->select('users.*', 'user_profile.*', 'users_permission.*', 'user_photo.*')
                    ->leftjoin('user_profile', 'user_profile.user_id', '=', 'users.user_id')
                    ->leftjoin('user_photo', 'user_photo.user_id', '=', 'users.user_id')
                    ->leftjoin('users_permission', 'users_permission.user_permission_id', '=', 'users.user_permission_id')
                    ->whereNull('users.deleted_at') 
                    ->where('users.user_id', '=', Auth::user()->user_id)
                    ->first();
        return $profile;
    }

    //edit user is admin
    public function editProfileIsAdmin($input)
    {
        DB::beginTransaction();
        try{
            //Update users
            DB::table('users')
                ->where('user_id', $input['user_id'])
                ->update([
                    'name'  => $input['name'],
                    'user_permission_id'  => $input['permission']
                ]);

            //Update image
            if(!empty($input['image_user'])){
                $filename = uniqid() . "." . $input["image_user"]->getClientOriginalExtension();

                //Update users
                DB::table('users')
                    ->where('user_id', $input['user_id'])
                    ->update([
                        'image'  => $filename
                    ]);

                $data = array(
                    'user_id'       => $input['user_id'],
                    'type'          => '1',
                    'filename'      => $filename,
                    'filepath'      => config('constants.avatar_savedir'),
                    'size'          => $input["image_user"]->getSize(),
                    'mime'          => $input["image_user"]->getMimeType(),
                    'org_filename'  => $input["image_user"]->getClientOriginalName(),
                );

                $check_photo = DB::table('user_photo')->select('*')->where('user_id', '=', $input['user_id'])->first();
                if(!empty($check_photo)){
                    //Delete dir image_user
                    $image_path = config('constants.avatar_savedir')."/".$check_photo->filename;
                    if(\File::exists($image_path)) {
                        \File::delete($image_path);
                    }
                    //Update image_user
                    UserPhoto::find($check_photo->user_photo_id)->update($data);
                    move_uploaded_file($_FILES['image_user']['tmp_name'], config('constants.avatar_savedir')."/".$filename);
                }else{
                    //Create image_user
                    UserPhoto::create($data);
                    move_uploaded_file($_FILES['image_user']['tmp_name'], config('constants.avatar_savedir')."/".$filename);
                }
            }

            //Check phoneUser
            $phoneUser = '';
            if (!empty($input['phoneUser'])) {
                foreach ($input['phoneUser'] as $key => $value) {
                    $phoneUser =  $phoneUser.$input['phoneUser'][$key].',';
                }
                $phoneUser = rtrim($phoneUser, ',');
            }

            //Check genderUser
            $genderUser = 0;
            if (!empty($input['gender'])) {
                $genderUser = $input['gender'];
            }

            $data_profile = array(
                'user_id'       => $input['user_id'],
                'phone'         => $phoneUser,
                'address'       => $input['address'],
                'date'          => $input['date'],
                'month'         => $input['month'],
                'year'          => $input['year'],
                'gender'        => $genderUser,
                'information'   => $input['information'],
            );

            $check_profile = DB::table('user_profile')->select('*')->where('user_id', '=', $input['user_id'])->first();
            if(!empty($check_profile)) {
                //Update profile
                UserProfile::find($check_profile->user_profile_id)->update($data_profile);
            }else{
                //Create profile
                UserProfile::create($data_profile);
            }

            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function getDataUserInModal($input)
    {
        
        $profile = DB::table('users')
                    ->select(
                        'users.*', 
                        'user_profile.phone', 
                        'user_profile.address', 
                        'user_profile.date', 
                        'user_profile.month', 
                        'user_profile.year', 
                        'user_profile.gender', 
                        'user_profile.information', 
                        'users_permission.name_permission', 
                        'users_permission.detail_permission', 
                        'user_photo.filename'
                    )
                    ->leftjoin('user_profile', 'user_profile.user_id', '=', 'users.user_id')
                    ->leftjoin('user_photo', 'user_photo.user_id', '=', 'users.user_id')
                    ->leftjoin('users_permission', 'users_permission.user_permission_id', '=', 'users.user_permission_id')
                    ->orderBy('users.user_id', 'desc')
                    ->whereNull('users.deleted_at') 
                    ->where('users.user_id', '=', $input['user_id'])
                    ->get();
        return $profile;
    }

    public function changePassword($input)
    {
        DB::table('users')
            ->where('user_id', $input['user_id_change_password'])
            ->update([
                'password' => bcrypt($input['password']),
            ]);
        return true;
    }

    public function checkEmail($input)
    {
        $users = DB::table('users')
                    ->select('*')
                    ->get();
        $exist = 0;
        foreach ($users as $key => $value) {
            if ($value->email == $input['email']) { $exist++; }
        }
        if ($exist > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function store($input)
    {
        DB::table('users')
            ->insert([
                'name'                  => $input['name'],
                'email'                 => $input['email'],
                'password'              => bcrypt($input['password']),
                'user_permission_id'    => $input['permission'],
                'created_at'            => now(),
            ]);

        return true;
    }

    public function search($input)
    {
        $pagination = SystemPagination::where('user_id', Auth::user()->user_id)->first();
        $search = DB::table('users')
                    ->select(
                        'users.*', 
                        'users_permission.name_permission', 
                        'users_permission.detail_permission',
                        'user_photo.filename'
                    )
                    ->leftjoin('users_permission', 'users_permission.user_permission_id', '=', 'users.user_permission_id')
                    ->leftjoin('user_photo', 'user_photo.user_id', '=', 'users.user_id')
                    ->orderBy('users.user_id', 'desc')
                    ->whereNull('users.deleted_at')
                    ->where('users.email', 'like', '%' . $input['searchUser'] . '%')
                    ->paginate(empty($pagination) ? 5 : $pagination['pagination_backend']);
        return $search;
    }

    public function searchUserRestore($input)
    {
        $pagination = SystemPagination::where('user_id', Auth::user()->user_id)->first();
        $search = DB::table('users')
                    ->select(
                        'users.*', 
                        'users_permission.name_permission', 
                        'users_permission.detail_permission',
                        'user_photo.filename'
                    )
                    ->leftjoin('users_permission', 'users_permission.user_permission_id', '=', 'users.user_permission_id')
                    ->leftjoin('user_photo', 'user_photo.user_id', '=', 'users.user_id')
                    ->orderBy('users.user_id', 'desc')
                    ->whereNotNull('users.deleted_at')
                    ->where('users.email', 'like', '%' . $input['searchUser'] . '%')
                    ->paginate(empty($pagination) ? 5 : $pagination['pagination_backend']);
        return $search;
    }

    public function delete($input)
    {
        if(!empty($input['user_id'])) {
            User::whereIn("user_id",$input['user_id'])->delete(); 
            return true;
        }
    }

    //khoi phuc user
    public function restoreUsers($input)
    {
        DB::beginTransaction();
        try{
            for ($i=0; $i < count($input['user_id']); $i++) { 
                User::withTrashed()->find($input['user_id'][$i])->restore();
            }
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

}