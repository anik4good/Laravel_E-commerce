<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function brands()
    {
        return $this->belongsToMany(Brand::class)->withTimestamps();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    
}
