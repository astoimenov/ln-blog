<?php

namespace LittleNinja;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $table = 'comments';

    protected $fillable = [
        'user_name',
        'user_email',
        'comment_content',
        'commentable_id',
        'commentable_type'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}
