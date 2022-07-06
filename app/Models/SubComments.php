<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubComments extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id', 'description'];

    public function comments()
    {
        return $this->belongsToMany(Comments::class);
    }
}
