<?php

namespace App\Repositories;

use App\Jobs\SetUserAvatar;
use App\Topic;
use App\User;
use Auth;
use Faker;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Events\UserRegistered;

class UserRepository
{

    use DispatchesJobs;

    public function findByUsername($username)
    {
        return User::whereUsername($username)->firstOrfail();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function ourPicks()
    {
        // for now do random
        return User::orderByRaw("RAND()")->take(5)->get();
    }

    public function likes($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $likes = $user->likes();

        return $likes;
    }

    public function getAllLikedBooks($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $likedBooks = $user->allLikedBooks();

        return $likedBooks;
    }

    public function getAllTopics($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $topics = $user->topics()->withCount('followers')->get();
        $topics->load('followers');

        return $topics;
    }

    public function findByFacebookUserIdOrCreate($userData)
    {
        $user = User::firstOrNew(['facebook_user_id' => $userData->id]);
        $user->name = $userData->name;
        $user->email = $userData->email;
        $user->fb_token = $userData->token;

        $user->avatar = $userData->avatar_original;
        // if (!$user->avatar && !is_null($avatar)) {
        //     $user->avatar = $avatar;
        // }

        $user->facebook_user_id = $userData->id;
        // if user already has a username do nothing.
        if (!$user->username) {
            // try to create a username for FB connected users
            $newUsername = str_slug($userData->name, '_');
            // make sure we do not have this username already in db
            if (User::where('username', $newUsername)->count() > 0) {
                // if we do then generate a random fake username
                $faker = Faker\Factory::create();
                $newUsername = str_replace('.', '_', $faker->unique()->userName);
            }
            $user->username = $newUsername;
        }
        $user->save();

        dispatch((new SetUserAvatar($user))->onQueue('users_avatar'));

        event(new UserRegistered($user));

        return $user;
    }

    public function findByTwitterUserIdOrCreate($userData)
    {
        $user = User::firstOrNew(['twitter_user_id' => $userData->id]);
        $user->name = $userData->name;
        $user->email = $userData->email;

        $user->avatar = $userData->avatar_original;

        // $avatar = $userData->avatar_original;
        // if (!$user->avatar && !is_null($avatar)) {
        //     $user->avatar = $avatar;
        // }

        $user->twitter_user_id = $userData->id;
        // if user already has a username do nothing.
        if (!$user->username) {
            // try to use the twitter handle
            $newUsername = $userData->nickname;
            // make sure we do not have this username already in db
            if (User::where('username', $newUsername)->count() > 0) {
                // if we do then generate a random fake username
                $faker = Faker\Factory::create();
                $newUsername = str_replace('.', '_', $faker->unique()->userName);
            }
            $user->username = $newUsername;
        }
        $user->save();

        dispatch((new SetUserAvatar($user))->onQueue('users_avatar'));

        event(new UserRegistered($user));

        return $user;
    }

    public function connectUserToFacebook($fbUser, $authUser)
    {
        // connect the user with facebook by setting
        // fb_token and facebook_user_id for this user
        $authUser->fb_token = $fbUser->token;
        $authUser->facebook_user_id = $fbUser->id;
        // try to set the avatar if it's not set yet.
        $authUser->avatar = is_null($authUser->avatar) ? $fbUser->avatar : $authUser->avatar;
        $authUser->save();
    }

    /**
     * Follow a  user.
     *
     * @param $userIdToFollow
     * @param User $user
     * @return mixed
    */
    public function follow($userIdToFollow, User $user)
    {
        return $user->followedUsers()->attach($userIdToFollow);
    }

    /**
     * Unfollow a user.
     *
     * @param $userIdToUnfollow
     * @param User $user
     * @return mixed
    */
    public function unfollow($userIdToUnfollow, User $user)
    {
        return $user->followedUsers()->detach($userIdToUnfollow);
    }

    public function current()
    {
        if (Auth::check()) {
            return User::find(Auth::id());
        }
    }
}
