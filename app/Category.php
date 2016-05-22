<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;

class Category extends Model
{
    protected $table = 'categories';

    /**
     * Get the book that owns the category.
     */
    public function books()
    {
        return $this->belongsToMany('App\Book');
    }
}
