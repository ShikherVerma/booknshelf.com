<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shelf extends Model
{
    protected $table = 'shelves';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get the user that created the Shelf.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
