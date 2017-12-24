<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Like extends Eloquent
{
    protected $collection = 'likes';
    protected $fillable = ['user_id','shop_id'];

    public function shops() {
        return $this->belongsTo('App\Shop','shop_id');
    }
}
