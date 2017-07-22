<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $table = 'notes';

    /**
     * The attributes that are mass assignable.
     *  *
     * @var array
     */
    protected $fillable = [
        'text',
        'is_private',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_private' => 'boolean',
    ];

    /**
     * Get the user that created this note.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Return the book that this note belongs to.
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
