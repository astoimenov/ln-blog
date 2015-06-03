<?php

namespace LittleNinja;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $table = 'tags';

    protected $fillable = [
        'tag_name',
        'tag_slug'
    ];

    public function posts()
    {
        return $this->belongsToMany('LittleNinja\Post');
    }
}
