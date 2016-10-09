<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard as Authenticator;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
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

    public function executeFacebook($hasCode, $listener)
    {
        if (!$hasCode) {
            return $this->getAuthorizationFirst();
        }

        // If user is authenticated at this point it means
        // we are connecting the profile in friends page.
        if ($this->auth->check()) {
            $this->users->connectUserToFacebook($this->getFacebookUser(), $this->auth->user());
            return redirect('/friends');
        }

        // either create a new user object or fetch existing one
        $user = $this->users->findByFacebookUserIdOrCreate($this->getFacebookUser());
        // log in the user
        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    public function executeTwitter($hasVerified, $listener)
    {
        if (!$hasVerified) {
            return $this->getTwitterAuthorizationFirst();
        }
        // either create a new user object or fetch existing one
        $user = $this->users->findByTwitterUserIdOrCreate($this->getTwitterUser());
        // // log in the user
        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst()
    {
        // TODO: Add 'user_actions.books' to scopes array when ready.
        return Socialite::driver('facebook')
            ->scopes(['email', 'user_friends'])->redirect();
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
