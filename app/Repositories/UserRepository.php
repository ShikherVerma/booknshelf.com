<?php

namespace App\Repositories;

use App\Jobs\SetUserAvatar;
use App\User;
use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Faker;

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

    public function findByFacebookUserIdOrCreate($userData)
    {
        $user = User::firstOrNew(['facebook_user_id' => $userData->id]);
        $user->name = $userData->name;
        $user->email = $userData->email;
        $avatar = $userData->avatar_original;
        $user->avatar = $avatar;
        if (!is_null($avatar)) {
            $user->avatar = preg_replace("/^http:/i", "https:", $avatar);
        }
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

        $this->dispatch(new SetUserAvatar($user));

        return $user;
    }

    public function findByTwitterUserIdOrCreate($userData)
    {
        $user = User::firstOrNew(['twitter_user_id' => $userData->id]);
        $user->name = $userData->name;
        $user->email = $userData->email;
        $avatar = $userData->avatar_original;
        $user->avatar = $avatar;
        if (!is_null($avatar)) {
            $user->avatar = preg_replace("/^http:/i", "https:", $avatar);
        }
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

        $this->dispatch(new SetUserAvatar($user));

        return $user;
    }

    public function current()
    {
        if (Auth::check()) {
            return User::find(Auth::id());
        }
    }
}
