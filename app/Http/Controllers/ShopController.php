<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Like;

class ShopController extends Controller
{
    protected $location = [];

    public function index(Request $request)
    {
        $this->location = $request->location;

        if($request->sorted !== 'true')
        {
            $shops = Shop::all();
        }
        else {
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

    public function preferred() {
        $likes = Like::all();

        $shopId = $likes->map(function($value) {
            return $value->shop_id;
        });

        return view('shop.preferred',[
            'shops' => Shop::find($shopId)
        ]);
    }
}