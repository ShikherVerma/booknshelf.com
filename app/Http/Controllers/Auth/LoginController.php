<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

require_once base_path('app/Services/Goodreads/GoodreadsAPI.php');


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'loginFacebook']]);
    }

    public function username()
    {
        return 'username';
    }

    public function loginFacebook(AuthenticateUser $authenticateUser, Request $request)
    {
        return $authenticateUser->executeFacebook($request->has('code'), $this);
    }

    public function loginTwitter(AuthenticateUser $authenticateUser, Request $request)
    {
        return $authenticateUser->executeTwitter($request->has('oauth_verifier'), $this);
    }

    public function loginGoodreads(AuthenticateUser $authenticateUser, Request $request)
    {
        return $authenticateUser->executeGoodreads($request->has('oauth_token'), $this);
    }

    public function userHasLoggedIn($user)
    {
        // if user is not on-boarded then send user to the welcome page
        if (!$user->is_onboarded) {
            return redirect('/welcome');
        }
        return redirect('/');
    }
}
