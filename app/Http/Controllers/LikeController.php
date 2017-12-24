<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;

class LikeController extends Controller
{
    public function store(Request $request,Shop $shop) {

        if(! $shop->likes()->exists())
        {
            $shop->likes()->create();
        }

        return response()->json(['success' => true]);
    }
}
