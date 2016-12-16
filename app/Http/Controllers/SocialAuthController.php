<?php

namespace Library\Http\Controllers;

use Illuminate\Http\Request;

use Library\Http\Requests;
use Library\Http\Controllers\Controller;
use Library\Providers\SocialAccountService;
use Socialite;

class SocialAuthController extends Controller
{
   public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user());

        auth()->login($user);

        return redirect()->to('/home');
    }
}
