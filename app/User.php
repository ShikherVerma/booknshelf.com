<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Searchable, Notifiable;
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
        'is_onboarded',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'fb_token',
        'is_onboarded',
        'created_at',
        'updated_at',
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

    public function isFacebookConnected()
    {
        return $this->facebook_user_id && $this->fb_token;
    }


    /**
     * Get all the likes of the model
     *
     * @return array of likes
     */
    public function likes()
    {
        return Like::with('book')->where([
            'user_id' => $this->id,
        ])->get();
    }

    /**
     * Get all liked books of the user.
     *
     * @return collection of books
     */
    public function allLikedBooks()
    {
        $likes = Like::with('book', 'book.likes', 'book.authors')->where([
            'user_id' => $this->id,
        ])->get();
        $books = $likes->map(function ($item) {
            return $item->book;
        });

        return $books;
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
