<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use App\Shop;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like(Shop $shop) {
        
        if(! $shop->isLiked())
        {
            $shop->likes()->create([
                'user_id' => auth()->user()->id
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function dislike(Shop $shop) {
        if($shop->isLiked())
        {
            $shop->likes()->where('user_id',auth()->user()->id)->first()->delete();

            $shop->dislikes()->create([
                'user_id' => auth()->user()->id
            ]);
        }
    }

    public function destroy(Shop $shop) {
        $shop->likes()->where('user_id',auth()->user()->id)->delete();
        return response()->json(['success' => true]);
    }
}
