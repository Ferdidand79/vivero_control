<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elemento extends Model
{
    public function image(){
        return $this->hasMany('App\Image');
    }
}
