<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sj',function(){
    return response()->json([
        'success'=>true,
        'message'=>'Successfull'
    ],200);
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'destroyToken'])->middleware('auth:api');

Route::middleware('auth:api')->controller(CategoryController::class)->prefix('category')->group(function(){
   
    Route::get('/','index');
    Route::get('/{id}','show')->middleware('permission:Create');
    Route::post('/create','store')->middleware('permission:Create');
    Route::put('/update/{id}','update')->middleware('permission:Update');
    Route::delete('/{id}','destroy')->middleware('permission:Delete');
});



