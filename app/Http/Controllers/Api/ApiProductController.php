<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecomproduct;

class ApiProductController extends Controller
{
    //


    

       public function recentProducts(Request $request){
         $count = $request->get('count',10);
         $products = Ecomproduct::orderBy('created_at','desc')->take($count)->get();
         return response()->json([
            'status'=>'success',
            'count'=> $count ,
            'count_total'=> $count ,
            'products'=>$products,
         ]);
    }
}
