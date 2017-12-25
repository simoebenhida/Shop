<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class Dislike extends Eloquent
{
    protected $fillable = ['user_id','shop_id'];

    public function shops() {
        return $this->belongsTo('App\Shop','shop_id');
    }

    public function TwoHours() {
        return $this->created_at->diffInHours(Carbon::now()) > 2;
    }
}
