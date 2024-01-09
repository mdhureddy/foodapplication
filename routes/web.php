<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\googleAuthController;
use App\Http\Controllers\ownergoogleAuthController;
use App\Http\Controllers\additemscontroller;
use App\Http\Controllers\userDataController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\nearstmapController;
use App\Http\Controllers\allfooditemsController;
use App\Http\Controllers\OwnerregisterController;


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



Route::view('userlogin','userlogin');
Route::view('profile','profile');
Route::view('ownerdashboard','ownerdashboard');
Route::get('ownerdashboard',[ownergoogleAuthController::class,'owners_added_items']);
Route::view('ownerlogin','ownerlogin');

Route::get('auth/google',[googleAuthController::class,'redirect'])->name('google-auth');
Route::get('auth/google/call-back',[googleAuthController::class,'callbackGoogle']);

Route::post('ownerlogin',[ownergoogleAuthController::class,'ownerlogin_validation']);
Route::get('/profile',[ownergoogleAuthController::class,'owner_profile']);
Route::put('update_profile/{id}',[ownergoogleAuthController::class,'update_profile']);

////////////////////Owner added data/////////////////////////////////

Route::view('/additems','additems');
Route::post('/additems',[additemscontroller::class,'add_items'])->name('additem');
Route::get('/additems',[additemscontroller::class,'add_particular_item'])->name('additems');


//////////user getting data///////////////////////////
Route::get('/userdashboard',[userDataController::class,'items_data'])->name('userdashboard');
////////wishlist///////////////
Route::post('addcard/{id}',[additemscontroller::class,'addcard'])->name('addcard');
Route::get('wishlist', [WishlistController::class, 'wishlist_data'])->name('wishlist');
Route::get('display_data', [WishlistController::class, 'display_data']);
Route::delete('delete/{user_id}', [WishlistController::class, 'delete_data']);
// Route::post('delete/{user_id}', [WishlistController::class, 'delete_data_add']);
Route::get('/success/{id}', [WishlistController::class,'success'])->name('success');
Route::get('/checkout', [WishlistController::class,'checkout'])->name('checkout');

///////////////orders data for both user and owner///////////////////////
Route::delete('delete/{user_id}/{item_id}', [WishlistController::class, 'delete_particular_item']);
Route::get('order', [ownergoogleAuthController::class, 'owner_orderd_data']);
Route::get('userorder',[googleAuthController::class, 'users_orderd_data']);
/////Map//////////////////


/////////All Food section Code///////////////
Route::get('/veg', [allfooditemsController::class, 'veg_food'])->name('veg');
Route::get('/nonveg', [allfooditemsController::class, 'nonveg_food'])->name('nonveg');
Route::get('/fastfood', [allfooditemsController::class, 'fast_food'])->name('fastfood');
Route::get('/softdrink', [allfooditemsController::class, 'softdrink_food'])->name('softdrink');
//////////////////////////////////////



/////////////////////////////////////
Route::view('ownerregister','ownerregister');
Route::post('ownerregister',[OwnerregisterController::class,'owners_register'])->name('ownerregister');

Route::get('/maploc',[nearstmapController::class,'findNearst']);
Route::view('/test','test');
Route::get('/test',[userDataController::class,'map']);

Route::view('test','test');



