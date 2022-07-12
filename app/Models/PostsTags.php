<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsTags extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'tag_id'];


    public function posts()
    {
        return $this->belongsTo(Posts::class);
    }

    public function tags()
    {
        return $this->belongsTo(Tags::class);
    }
}
