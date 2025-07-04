<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiBannerController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/categories', [ApiController::class, 'getCategories']);
Route::get('/recenetproducts',[ApiProductController::class,'recentProducts']);
Route::get('/banners', [ApiBannerController::class, 'getBanners']);
