<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Shop extends Eloquent
{
    protected $collection = 'shops';

    public function likes() {
        return $this->hasMany('App\Like');
    }

    public function dislikes() {
        return $this->hasMany('App\Dislike');
    }

    public function isLiked() {
        return $this->likes()->where('user_id',auth()->user()->id)->exists();
    }

    public function toArray()
    {
        return array_merge(parent::toArray(),[
            'like' => $this->isLiked()
        ]);
    }

    public function scopeFilter($query)
    {
        $this->removeLikedShops($query);
        $this->removeDislikedShops($query);
    }


    public function removeLikedShops($query) {
        $likes = Like::where('user_id',auth()->user()->id)->get();

        $shopId = $likes->map(function($value) {
            return $value->shop_id;
        });

        return $query->whereNotIn('_id',$shopId);
    }

    public function removeDislikedShops($query) {
        $dislikes = Dislike::where('user_id',auth()->user()->id)->get();
        $shopID = $dislikes->map(function($value) {
            if(! $value->TwoHours()) {
                return $value->shop_id;
            }
        });
        return $query->whereNotIn('_id',$shopID);
    }
}
