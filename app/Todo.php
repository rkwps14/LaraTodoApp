<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    protected $table = "todo";
    

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
