<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    // === Auth ===//
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::get('/user-profile', 'AuthController@userProfile');   
});

// Route::group(['middleware' => 'auth:api'],function () {
    // ========================
    //          ADMIN
    // =========================


    // === User ===//
    Route::apiResource('/admin/user', 'AdminUserController');
    Route::post('/admin/profile', 'AdminUserController@profile');


    // === Permission ===//
    Route::apiResource('/admin/permission','AdminPermissionController');


    // === Role ===//
    Route::apiResource('/admin/role','AdminRoleController');




     // === Category product ===//
     Route::get('/admin/cat-product', 'AdminCategoryProductController@index');
     Route::get('/admin/cat-product/{id}', 'AdminCategoryProductController@show');
     Route::post('/admin/cat-product', 'AdminCategoryProductController@store');
     Route::put('/admin/cat-product/{id}', 'AdminCategoryProductController@update');
     Route::delete('/admin/cat-product/trash/{id}','AdminCategoryProductController@goToTrash');
     Route::delete('/admin/cat-product/{id}', 'AdminCategoryProductController@destroy');
     Route::delete('/admin/cat-product/restore/{id}', 'AdminCategoryProductController@restore');
 
     // === Product ===//
     // Route::get('/admin/product/{id}', 'AdminProductController@show');
     // Route::post('/admin/product', 'AdminProductController@store');
     // Route::put('/admin/product/{id}', 'AdminProductController@update');
     // Route::delete('/admin/product/{id}', 'AdminProductController@destroy');
     // Route::apiResource('product', 'AdminProductController');

      // === Permission ===//



      // === Setting ===//
      Route::get('admin/setting/general','AdminSystemGenaralController@index');



// });