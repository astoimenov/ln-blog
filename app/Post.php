<?php

namespace LittleNinja;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $table = 'posts';

    protected $fillable = [
        'post_title',
        'post_slug',
        'post_content'
    ];

    public function author()
    {
        return $this->belongsTo('LittleNinja\User');
    }

    public function categories()
    {
        return $this->belongsToMany('LittleNinja\Category')->withPivot('category_id', 'news_id');
    }

    public function comments()
    {
        return $this->morphMany('LittleNinja\Comment', 'commentable');
    }

    public function tags()
    {
        return $this->belongsToMany('LittleNinja\Tag');
    }
}
