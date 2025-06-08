<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;

class ApiBannerController extends Controller
{
    //

    public function getBanners(){

        $bannersdata = Banner::all();
        return response()->json([
           'status'=>'success',
            'news_info'=> $bannersdata
        ]);
    }
}
