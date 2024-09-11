<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Routes for the Categories

Route::prefix('category')->name('category.')->middleware('auth')->group(function(){

    Route::get('/',[CategoryController::class,'index'])->name('index');
    Route::get('/createNew',[CategoryController::class,'create'])->name('create');
    Route::post('/storeNew',[CategoryController::class,'store'])->name('store')->middleware('role:superAdmin');
    Route::get('/edit/{id}',[CategoryController::class,'edit'])->name('edit');
    Route::delete('/delete/{id}',[CategoryController::class,'destroy'])->name('destroy')->middleware('permission:Delete');
    Route::patch('/edit/status/{id}',[CategoryController::class,'changeStatus'])->name('changeStatus')->middleware('permission:Update');
    Route::patch('/edit/category/{id}',[CategoryController::class,'update'])->name('update')->middleware('permission:Update');
});

Route::middleware('auth')->group(function(){

    Route::resource('post',PostController::class);
    Route::get('/loadPost',[PostController::class,'loadPost'])->name('post.loadPost');
    Route::patch('post/edit/status/{id}',[PostController::class,'changeStatus'])->name('post.changeStatus');
    Route::delete('post/delete/images/{id}',[PostController::class,'destroyImages'])->name('post.destroy.img');
});
Route::middleware('auth')->group(function(){

    Route::get('/rolePermission',[RolePermissionController::class,'dahboard'])->name('dashboard');
    Route::get('/rolePermission',[RolePermissionController::class,'dahboard'])->name('dashboard');
});


Route::resource('permission',PermissionController::class);
Route::resource('role',RoleController::class);
Route::post('/setPermission/{id}',[RolePermissionController::class,'setPermission'])->name('role.setPermission');
Route::get('/checkPermission/{id}',[RolePermissionController::class,'getPermission'])->name('role.checkPermission');

Route::middleware('role:superAdmin')->controller(RolePermissionController::class)->group(function(){

    Route::get('/getUserWithRole','getUserWithRole')->name('role.getUserWithRole');
    Route::get('/showUserWithRole/{id}','showUserWithRole')->name('role.showUserWithRole');
    Route::post('/setUserWithRole/{id}','setUserWithRole')->name('role.setUserWithRole');
});




Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
