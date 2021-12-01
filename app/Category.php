<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
   protected $table = "category";

   public function todos()
    {
        return $this->hasMany('App\Todo');
    }
}
