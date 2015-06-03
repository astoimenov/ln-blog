<?php

namespace LittleNinja;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = [
        'deleted_at'
    ];

    protected $table = 'categories';

    protected $fillable = [
        'category_name',
        'category_slug'
    ];

    public function posts()
    {
        return $this->belongsToMany('LittleNinja\Post');
    }
}
