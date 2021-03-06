<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
class Movie extends Model
{
    public function category()
    {
      return $this->belongsTo(Category::class);
    }
    public function favourites()
    {
      return $this->hasMany('Favourite');
    }
}
