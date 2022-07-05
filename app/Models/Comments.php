<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'description'];

    public function posts()
    {
        return $this->belongsToMany(Posts::class);
    }
}
