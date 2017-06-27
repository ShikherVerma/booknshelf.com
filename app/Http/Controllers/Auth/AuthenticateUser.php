<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\Guard as Authenticator;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Socialite;
use Illuminate\Http\Request;
use App\Jobs\CreateUserGoodreadsShelves;

require_once base_path('app/Services/Goodreads/GoodreadsAPI.php');

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
        // log in the user
        $this->auth->login($user, true);

        return $listener->userHasLoggedIn($user);
    }

    public function executeGoodreads($oauthToken, $listener)
    {
        if (!$oauthToken) {
            return $this->getGoodreadsAuthorizationFirst();
        }

        session_start();
        $obj = new \GoodreadsApi(
            env('GOODREADS_KEY'),
            env('GOODREADS_SECRET'),
            $_SESSION['oauth_token'],
            $_SESSION['oauth_token_secret']
        );

        $accessToken = $obj->getAccessToken($_REQUEST['authorize']);
        $_SESSION['access_token'] = $accessToken;

        unset($_SESSION['oauth_token'], $_SESSION['oauth_token_secret'] ,$obj);

        $obj = new \GoodreadsApi(
            env('GOODREADS_KEY'),
            env('GOODREADS_SECRET'),
            $accessToken['oauth_token'],
            $accessToken['oauth_token_secret']
        );

        $content = $obj->doGet('http://www.goodreads.com/api/auth_user');
        $userJsonData = $this->convertXmlToJson($content);

        $userId = $userJsonData['user']['@attributes']['id'];
        $content = $obj->doGet("https://www.goodreads.com/user/show/{$userId}.xml?id=$userId");
        $userJsonData = $this->convertXmlToJson($content);

        // either create a new user object or fetch existing one
        $user = $this->users->findByGoodreeadsUserIdOrCreate($userJsonData, $accessToken);

        // log in the user
        $this->auth->login($user, true);

        // get user's shelves from Goodreads
        $userGoodreadsShelves = $userJsonData['user']['user_shelves']['user_shelf'];

        if (!empty($userGoodreadsShelves)) {
            // import the goodreads shelves from Goodreads in the background
            dispatch((new CreateUserGoodreadsShelves($user, $userGoodreadsShelves))
                ->onQueue('user_import_goodreads_shelves'));
        }

        return $listener->userHasLoggedIn($user);
    }

    private function getAuthorizationFirst()
    {
        return Socialite::driver('facebook')
            ->scopes(['email', 'user_friends'])->redirect();
    }

    private function getGoodreadsAuthorizationFirst()
    {
        session_start();
        $connection = new \GoodreadsAPI(env('GOODREADS_KEY'), env('GOODREADS_SECRET'));
        $requestToken = $connection->getRequestToken(env('GOODREADS_CALLBACK_URL'));

        $_SESSION['oauth_token']  = $requestToken['oauth_token'];
        $_SESSION['oauth_token_secret'] = $requestToken['oauth_token_secret'];
        $authorizeUrl = $connection->getLoginURL($requestToken);
        return redirect($authorizeUrl);
    }

    private function getFacebookUser()
    {
        return Socialite::driver('facebook')->stateless()->user();
    }

    private function getTwitterAuthorizationFirst()
    {
        return Socialite::driver('twitter')->redirect();
    }

    private function getTwitterUser()
    {
        return Socialite::driver('twitter')->user();
    }

    private function convertXmlToJson($xmlString)
    {
        $xml = simplexml_load_string($xmlString);
        $json = json_encode($xml);
        return json_decode($json, true);
    }

}
