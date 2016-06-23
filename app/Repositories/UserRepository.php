<?php

namespace App\Repositories;

use App\User;
use Auth;

class UserRepository {

    public function findByEmailOrCreate($userData)
    {
        $user = User::firstOrNew(['email' => $userData->email]);
        $user->name = $userData->name;
        $user->avatar = $userData->avatar_original;
        // if user already has a username do nothing.
        if(!$user->username) {
            // try to create a username for FB connected users
            $newUsername = str_slug($userData->name, '_');
            // make sure we do not have this username already in db
            if(User::where('username', $newUsername)->count() > 1){
                $newUsername = str_slug($userData->email);
            }
            $user->username = $newUsername;
        }
        $user->save();
        return $user;
    }

    public function current()
    {
        if (Auth::check()) {
            return User::find(Auth::id());
        }
    }

}