<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;

class User extends Authenticatable
{
    use AlgoliaEloquentTrait;

    public static $perEnvironment = true;

    public function autoIndex()
    {
        if (env('APP_ENV') === 'testing' || env('APP_ENV') === 'local') {
            return false;
        }
        return true;
    }

    public function autoDelete()
    {
        if (env('APP_ENV') === 'testing') {
            return false;
        }
        return true;
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
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
        'is_onboarded',
        'created_at',
        'updated_at'
    ];

    /**
     * Get all of the user's shelves.
     */
    public function shelves()
    {
        return $this->hasMany(Shelf::class)->orderBy('created_at', 'desc');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
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
