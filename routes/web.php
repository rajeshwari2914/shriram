<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShriramController;
/** Shopee SL Mart All Controllers **/



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
/*Route::get('admin', function () {
    return view('login');
});
Route::get('admin', function () {
    return view('shopee.index');
});*/
/** Start Front End Route's **/
Route::get('/',[FrontController::class,'loginadmin']);
Route::post('checklogin',[FrontController::class,'checklogin']);
Route::get('index',[FrontController::class,'backendlink']);
Route::resource('details',ShriramController::class);


Route::get('sessionoff',[FrontController::class,'sessionoff']);
// Route::get('index',[FrontController::class,'index']);
// Route::get('forget',[FrontController::class,'forget']);
// Route::get('remove',[FrontController::class,'deleteSessionData']);

/** End Front End Route's **/

Route::resource('products',ProductController::class);
Route::get('printbill/{id}',[ShriramController::class,'printbill']);











