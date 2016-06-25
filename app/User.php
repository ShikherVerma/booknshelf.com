<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'avatar',
        'about',
        'is_onboarded'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'facebook_user_id',
        'twitter_user_id',
        'created_at',
        'updated_at'
    ];

    /**
     * Get all of the user's shelves.
     */
    public function shelves()
    {
        return $this->hasMany(Shelf::class)->orderBy('created_at', 'asc');
    }

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_onboarded' => 'boolean',
    ];
}
