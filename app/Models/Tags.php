<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    protected $fillable = ['tag_title'];

    public function posts()
    {
        return $this->belongsToMany(Posts::class, 'posts_tags', 'tag_id', 'post_id');
    }

    public function postsTags()
    {
        return $this->hasMany(PostsTags::class, 'tag_id');
    }
}
