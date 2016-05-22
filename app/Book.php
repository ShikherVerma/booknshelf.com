<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Author;
use App\Category;

class Book extends Model
{
    /**
     * Get the authors for the book.
     */
    public function authors()
    {
        return $this->belongsToMany('App\Author')->withTimestamps();
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category')->withTimestamps();
    }
}
