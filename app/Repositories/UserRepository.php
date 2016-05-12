<?php

namespace App\Repositories;

use App\User;

class UserRepository {

    public function findByEmailOrCreate($userData)
    {
        return User::firstOrCreate([
            'name' => $userData->name,
            'email' => $userData->email,
            'picture' => $userData->avatar,
        ]);
    }

}