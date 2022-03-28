<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Authintication

Route::get('/',[AdminAuthController::class,'login']);
Route::get('/login',[AdminAuthController::class,'login'])->middleware('alreadyLoggedIn');
Route::get('/register',[AdminAuthController::class,'register']);
Route::post('/register-user',[AdminAuthController::class,'RegisterUser']);
Route::post('/login-user',[AdminAuthController::class,'loginUser']);
Route::get('/dashboard',[AdminAuthController::class,'dashboard'])->middleware('isLoggedIn');
Route::get('/logout',[AdminAuthController::class,'logout']);



//Products 
Route::resource('/products', ProductController::class)->middleware('isLoggedIn');
//Category
Route::resource('/categories', CategoryController::class)->middleware('isLoggedIn');
//News
Route::resource('/news',NewsController::class)->middleware('isLoggedIn');