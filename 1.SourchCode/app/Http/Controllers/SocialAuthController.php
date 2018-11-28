<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Services\SocialAccountService;
use Illuminate\Support\Facades\Log;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $user = SocialAccountService::createOrGetUser(Socialite::driver($social)->user(), $social);
        if ( !empty($user) ) {
            auth()->login($user);
            return redirect()->to('/');
        } else {
            return redirect()->route('login')->with(['error' => 'Lỗi xác thực hoặc tài khoản đang bị khóa.']);
        }
    }
}
