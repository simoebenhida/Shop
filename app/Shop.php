<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Shop extends Eloquent
{
    protected $collection = 'shops';

    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function isLiked() {
        return $this->likes()->exists();
    }

    public function toArray()
    {
        return array_merge(parent::toArray(),[
            'like' => $this->isLiked()
        ]);
    }
}
