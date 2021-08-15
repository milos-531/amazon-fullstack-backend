<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::post('add_to_cart',[ProductController::class,'addToCart']);
Route::get("cartlist/{id}",[ProductController::class,'cartList']);
Route::get("getproducts/{id}",[ProductController::class,'getProducts']);
Route::post('remove_from_cart',[ProductController::class,'removeCart']);
Route::post('remove_from_orders',[ProductController::class,'removeOrder']);
Route::get("search/{req}",[ProductController::class,'search']);
Route::get("getorders/{user_id}",[ProductController::class,'getOrders']);
Route::post('placeorder',[ProductController::class,'orderPlace']);