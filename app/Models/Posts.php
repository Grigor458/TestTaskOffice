<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeLiked;

class Posts extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'user_id', 'title', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'posts_tags', 'post_id', 'tag_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(Likes::class, 'post_id');
    }

    public function isAuthUserLikedPost()
    {
        return $this->likes()
            ->where('user_id', auth()->id())
            ->where('is_liked', 1)
            ->first();
    }

    public function isAuthUserDissLikedPost()
    {
        return $this->likes()
            ->where('user_id', auth()->id())
            ->where('is_liked', 0)
            ->first();
    }
}
