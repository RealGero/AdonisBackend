<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController; 
use App\Http\Controllers\LoginController; 
use App\Http\Controllers\RegisterController; 
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\GuestsController; 
use App\Http\Controllers\CompanyController; 
use App\Http\Controllers\ReviewsController; 
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
    Route::post('/update-password',[UsersController::class, 'updatePassword']); 
    
    // GUEST ROUTE
    
    Route::post('/user/profile',[GuestsController::class,'store'])->name('user.store');
    Route::put('/user/update',[GuestsController::class,'update'])->name('user.update');
 
    Route::post('/user/image',[GuestsController::class,'guestUploadImage'])->name('user.image');
    Route::get('/user/home',[GuestsController::class,'index'])->name('user.home');
 
    // GUEST CAN REVIEW
    // Route::post('user/review',[ReviewController::class,''])
    


    // GUEST VISIT ONE COMPANY
    Route::get('user/company/{id}',[GuestsController::class,'showSpecificCompany'])->name('company.show');

    // COMPANY ROUTE
    Route::post('company/image',[CompanyController::class,'companyUploadImage'])->name('company.image');
    Route::post('company/profile',[CompanyController::class,'store'])->name('company.profile');
    Route::put('company/profile',[CompanyController::class,'update'])->name('company.profile.update');
    Route::get('company/home',[CompanyController::class,'index'])->name('company.home');
   



    // ADMIN ROUTE
    Route::get('admin/companies',[AdminController::class, 'getCompany']);
    Route::get('admin/guests',[AdminController::class, 'getGuests']);
    Route::post('admin/profile',[AdminController::class, 'storeAdminProfile']);
    Route::get('admin/profile/{id}',[AdminController::class, 'showProfile']);
    Route::post('admin/profile/{id}',[AdminController::class, 'updateAdminProfile']);

    // REVIEW ROUTE
    Route::post('review/{id}',[ReviewsController::class,'store'])->name('review.store');
    
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
