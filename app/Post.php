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
}
