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
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'is_verified',
        'verify_token',
        'created_at',
        'updated_at'
    ];

    public function confirmEmail()
    {
        $this->is_verified = true;
        $this->verify_token = null;
        $this->save();
    }

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
        'is_verified' => 'boolean',
    ];
}
