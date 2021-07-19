<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController; 
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\RegisterController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\GuestsController; 
use App\Http\Controllers\CompanyController; 
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



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware'=>['auth:api']],function(){
    // ALL
    Route::post('/logout',[UsersController::class, 'logout']); 
    Route::post('/update-password',[GuestsController::class, 'updatePassword']); 
    
    // GUEST ROUTE
    
    Route::post('/guest/profile',[GuestsController::class,'store'])->name('guest.store');
    Route::post('/guest/update',[GuestsController::class,'store'])->name('guest.update');
    Route::get('/users/home',[GuestsController::class,'index'])->name('guest.index');
    
    // COMPANY ROUTE
    Route::put('company/image',[CompanyController::class,'uploadImage'])->name('company.image');
    Route::post('company/profile',[CompanyController::class,'store'])->name('company.profile');
    
    // ADMIN ROUTE
    Route::get('admin/companies',[AdminController::class, 'getCompany']);
    Route::get('admin/guests',[AdminController::class, 'getGuests']);
    Route::post('admin/profile',[AdminController::class, 'storeAdminProfile']);
    Route::get('admin/profile/{id}',[AdminController::class, 'showProfile']);
    Route::post('admin/profile/{id}',[AdminController::class, 'updateAdminProfile']);
    
});
Route::post('/login',[UsersController::class, 'login'])->name('user.login');
Route::post('/register',[UsersController::class, 'register'])->name('register');
Route::get('/sample/get',[UsersController::class,'index']);


// Route::group([
//     'middleware' => 'auth:api'
// ],function()
// {
//     Route::get('/logout',UsersController::class,'logout');
//     Route::get('/user',UsersController::class,'user');
// });
// Route::post('/login',[UsersController::class, 'login']);
