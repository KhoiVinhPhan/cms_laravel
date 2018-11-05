<?php

namespace App\Handlers;

use Auth;
use Config;

class ConfigHandler
{
    public function userField()
    {
        //set language
        $language = \DB::table('system_language')->select('*')->where('user_id', '=', Auth::user()->user_id)->first();
        if (empty($language)) {
            \App::setLocale('vi');
        } else {
            \App::setLocale($language->language);
        }

        //permission file manager 
    	if (Auth::user()->user_permission_id ==  1) {
            Config::set('lfm.allow_multi_user', true);
        } else {
            Config::set('lfm.allow_multi_user', false);
            // echo \Config::get('lfm.allow_multi_user');
        }
        return auth()->user()->id;
    }
}
