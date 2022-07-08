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
        return $this->hasMany(Tags::class, 'post_id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(Likes::class, 'post_id');
    }
}
