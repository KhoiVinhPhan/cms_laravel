<?php

namespace Core\Repositories;

use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\SystemPagination;

class SystemRepository implements SystemRepositoryContract
{
    //change pagination
    public function pagination($input)
    {
        DB::beginTransaction();
        try{
            $pagination = DB::table('system_pagination')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
            if (empty($pagination)) {
                //create
                DB::table('system_pagination')
                    ->insert([
                        'pagination_backend'    => $input['pagination_backend'],
                        'pagination_frontend'   => $input['pagination_frontend'],
                        'user_id'               => Auth::user()->user_id
                    ]);
            } else {
                //update
                DB::table('system_pagination')
                    ->where('user_id', '=', $pagination->user_id)
                    ->update([
                        'pagination_backend'    => $input['pagination_backend'],
                        'pagination_frontend'   => $input['pagination_frontend'],
                        'user_id'               => Auth::user()->user_id
                    ]);
            }
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    //change color
    public function colors($input)
    {
        DB::beginTransaction();
        try{
            $color = DB::table('system_color')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
            if (empty($color)) {
                //create
                DB::table('system_color')
                    ->insert([
                        'color_menu_top'    => $input['data']['menuTop'],
                        'color_active_dark' => $input['data']['colorActive'],
                        'color_logo'        => $input['data']['logo'],
                        'sidebar'           => $input['data']['sidebar'],
                        'user_id'           => Auth::user()->user_id,
                    ]);
            } else {
                //update
                DB::table('system_color')
                    ->where('user_id', '=', $color->user_id)
                    ->update([
                        'color_menu_top'    => $input['data']['menuTop'],
                        'color_active_dark' => $input['data']['colorActive'],
                        'color_logo'        => $input['data']['logo'],
                        'sidebar'           => $input['data']['sidebar'],
                        'user_id'           => Auth::user()->user_id,
                    ]);
            }
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    //change language
    public function changeLanguage($input)
    {
        DB::beginTransaction();
        try{
            $language = DB::table('system_language')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
            if (empty($language)) {
                //create
                DB::table('system_language')
                    ->insert([
                        'language'    => $input['data']['value'],
                        'user_id'     => Auth::user()->user_id,
                    ]);
            } else {
                //update
                DB::table('system_language')
                    ->where('user_id', '=', $language->user_id)
                    ->update([
                        'language'    => $input['data']['value'],
                        'user_id'     => Auth::user()->user_id,
                    ]);
            }
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    //change editor
    public function editor($input)
    {
        DB::beginTransaction();
        try{
            $editor = DB::table('system_editor')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
            if (empty($editor)) {
                //create
                DB::table('system_editor')
                    ->insert([
                        'name'              => $input['editor'],
                        'version_ckeditor'  => $input['versionCkeditor'],
                        'user_id'           => Auth::user()->user_id,
                    ]);
            } else {
                //update
                DB::table('system_editor')
                    ->where('user_id', '=', $editor->user_id)
                    ->update([
                        'name'              => $input['editor'],
                        'version_ckeditor'  => $input['versionCkeditor'],
                        'user_id'           => Auth::user()->user_id,
                    ]);
            }
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    //update system general
    public function updateConfigSystem($input)
    {
        DB::beginTransaction();
        try{
            
            $data = DB::table('system_general')->select('*')->first();
            if (empty($data)) {
                //insert
                DB::table('system_general')
                    ->insert([
                        'image_logo'    => $input['image_logo'],
                        'title_logo'    => $input['title_logo'],
                        'user_id_maked' => Auth::user()->user_id
                    ]);
            } else {
                //update
                DB::table('system_general')
                    ->where('id', '=', $data->id)
                    ->update([
                        'image_logo'      => $input['image_logo'],
                        'title_logo'      => $input['title_logo'],
                        'user_id_updated' => Auth::user()->user_id
                    ]);
            }
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    //get data system general
    public function getDataConfigSystem()
    {
        $data = DB::table('system_general')->select('*')->first();
        return $data;
    }

}