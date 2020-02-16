<?php

namespace App;
use App\Movie;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    public function movies()
    {
      return $this->belongsTo(Movie::class);
    }
    public function users()
    {
      return $this->belongsTo(User::class);
    }
}
