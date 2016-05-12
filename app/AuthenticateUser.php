<?php

namespace App;

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

    public function execute($hasCode)
    {
		if(!$hasCode) return $this->getAuthorizationFirst();
        // so now we should either create a new user object or fetch existing one.
        $user = $this->users->findByEmailOrCreate($this->getFacebookUser());

        $this->auth->login($user, true);
    }

	private function getAuthorizationFirst()
	{
	    return Socialite::driver('facebook')->redirect();
	}

    private function getFacebookUser()
    {
        return Socialite::driver('facebook')->user();
    }
}
