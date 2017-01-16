<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    protected $fillable = ['user_id', 'book_id', 'comment'];
    /**
     * Get the book that owns the lile.
     */
    public function book()
    {
        return $this->belongsTo('App\Post');
    }
}
