<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ecomcategory;


class ApiController extends Controller
{
    //

        public function getIconAttribute($value)
        {
            // Assuming icons are stored in 'storage/icons/' directory
            return url('storage/icons/' . $value);
        }
    public function getCategories(){
        $categorydata = Ecomcategory::all();
        return response()->json([
            'status'=>'success',
             'categories'=> $categorydata
        ]);
    }
}
