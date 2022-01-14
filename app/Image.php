<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'elementos_image';

    public function elemento(){
        return $this->belongsTo('App\Elemento');
    }
}
