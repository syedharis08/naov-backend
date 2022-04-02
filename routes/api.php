<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('api')->group(function(){

    Route::post('sign-up',[UserController::class,'signup']);
    Route::post('login',[UserController::class,'login']);
    Route::get('get-user',[UserController::class,'getLoggedInUser']);
    Route::post('add-user-service',[UserController ::class,'addUserServices']);
    Route::get('get-services',[UserController ::class,'addGetServices']);
    Route::get('get-forwarders',[UserController ::class,'getForwarders']);
    Route::post('add-forwarders',[UserController ::class,'addForwarders']);
    Route::get('get-shippers',[UserController ::class,'getShippers']);
    Route::post('add-shipper',[UserController ::class,'addShipper']);

    Route::get('get-countries',[AddressController::class,'getCountries']);
    Route::get('get-states/{id}',[AddressController::class,'getStates']);
    Route::get('get-cities/{id}',[AddressController::class,'getCities']);


    Route::apiResource('service', ServiceController::class);
    Route::apiResource('role', RoleController::class);
    Route::apiResource('permission', PermissionController::class);
// });
