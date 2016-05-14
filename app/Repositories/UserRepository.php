<?php

namespace App\Repositories;

use App\User;

class UserRepository {

    public function findByEmailOrCreate($userData)
    {
        // Retrieve the user by the attributes, or instantiate a new instance...
        $user = User::firstOrNew(['email' => $userData->email]);
        $user->name = $userData->name;
        $user->picture = $userData->avatar;
        $user->save();
        return $user;
//        return $user;
//        return User::firstOrCreate([
//            'name' => $userData->name,
//            'email' => $userData->email,
//            'picture' => $userData->avatar,
//        ]);
    }

}