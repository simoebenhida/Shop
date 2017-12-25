<?php

namespace App\Http\Controllers;

use App\Dislike;
use Illuminate\Http\Request;
use App\Shop;
use App\Like;

class ShopController extends Controller
{
    protected $location = [];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $this->location = $request->location;

        $shops = Shop::filter()->get();

        if($request->sorted == 'true')
        {
            $shops = Shop::whereRaw([
                'location' => [
                    '$near' => [
                        '$geometry' => [
                            'type' => 'Point',
                            'coordinates' => [ $this->location['lat'],$this->location['lng']],
                        ],
                    ]
                ]
            ])->get();
        }

        return response()->json(['shops' => $shops]);
    }

    public function fetchData() {
        $shops = Shop::all();
        $shops = $this->removeLikedShops($shops);
        $shops = $this->removeDislikedShops($shops);
        return $shops;
    }

    public function fetchLikesID() {
        $likes = Like::where('user_id',auth()->user()->id)->get();

        return $likes->map(function($value) {
            return $value->shop_id;
        });
    }

    public function preferred() {
        return response()->json([
            'shops' => Shop::find($this->fetchLikesID())
        ]);
    }

}
