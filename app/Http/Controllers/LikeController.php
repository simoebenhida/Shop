<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;

class LikeController extends Controller
{
    public function store(Request $request,Shop $shop) {
        
        if(! $shop->isLiked())
        {
            $shop->likes()->create([
                'user_id' => auth()->user()->id
            ]);
        }

        return response()->json(['success' => true]);
    }
}
