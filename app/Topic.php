<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'slug',
        'cover_photo',
    ];

    /**
     * Return the users who follow this topic.
     */
    public function followers()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = str_slug($value);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function getTopicUrl()
    {
        return '/topics/' . $this->slug;
    }
}
