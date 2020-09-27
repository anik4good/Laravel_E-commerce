<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }
}
