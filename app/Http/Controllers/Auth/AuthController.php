<?php

namespace App\Http\Controllers\Auth;

use Event;
use App\User;
use Validator;
use Socialite;
use App\Http\Controllers\Auth\AuthenticateUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\UserRegistered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = $this->create($request->all());
        Auth::guard($this->getGuard())->login($user);

        Event::fire(new UserRegistered($user));
        flash()->info('Can you please verify your email?', '');

        return redirect($this->redirectPath());
    }

    public function confirmEmail($token)
    {
        User::where('verify_token', $token)->firstOrFail()->confirmEmail();
        flash()->success('Sweet!', 'You are now confirmed. Thanks so much!');

        return redirect('/home');
    }

    public function loginFacebook(AuthenticateUser $authenticateUser, Request $request)
    {
        return $authenticateUser->execute($request->has('code'), $this);
    }

    public function loginTwitter(AuthenticateUser $authenticateUser, Request $request)
    {
        return $authenticateUser->executeTwitter($request->has('oauth_verifier'), $this);
    }

    public function userHasLoggedIn($user)
    {
        return redirect('/');
    }
}
