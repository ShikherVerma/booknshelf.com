<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard as Authenticator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\UserRepository;
use App\Http\Requests;
use Socialite;

class AuthenticateUser extends Controller
{
    private $users;
    private $socialite;
    private $auth;

    public function __construct(UserRepository $users, Socialite $socialite, Authenticator $auth)
    {
        $this->users = $users;
        $this->socialite = $socialite;
        $this->auth = $auth;
    }

    public function execute($hasCode, $listener)
    {
        if(!$hasCode) return $this->getAuthorizationFirst();
        // either create a new user object or fetch existing one
        dd($this->getFacebookUser());
        $user = $this->users->findByEmailOrCreate($this->getFacebookUser());
        // log in the user
        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

        public function executeTwitter($hasCode, $listener)
        {
            if(!$hasCode) return $this->getTwitterAuthorizationFirst();
            // either create a new user object or fetch existing one
            dd($this->getTwitterUser());
            // $user = $this->users->findByEmailOrCreate($this->getTwitterUser());
            // // log in the user
            // $this->auth->login($user, true);

            // return $listener->userHasLoggedIn($user);
        }

    private function getAuthorizationFirst()
    {
        return Socialite::driver('facebook')->redirect();
    }

    private function getFacebookUser()
    {
        return Socialite::driver('facebook')->user();
    }

    private function getTwitterAuthorizationFirst()
    {
        return Socialite::driver('twitter')->redirect();
    }

    private function getTwitterUser()
    {
        return Socialite::driver('twitter')->user();
    }
}
