<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class Author extends Model
{
    protected $fillable = ['name'];
    /**
     * The books that belong to the author.
     */
    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}
