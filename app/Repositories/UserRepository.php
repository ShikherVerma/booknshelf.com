<?php

namespace App\Repositories;

use App\User;

class UserRepository {

    public function findByEmailOrCreate($userData)
    {
        // Retrieve the user by the attributes, or instantiate a new instance...
        $user = User::firstOrNew(['email' => $userData->email]);
        // TODO: what do we do when user does not have password from
        // facebook?
        $user->name = $userData->name;
        $user->avatar = $userData->avatar;
        $user->save();
        return $user;
    }

}