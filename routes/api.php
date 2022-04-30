<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CarrierController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SeaPortController;
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


Route::post('sign-up', [UserController::class, 'signup']);
Route::post('login', [UserController::class, 'login']);
Route::post('pre-signup/{user}', [UserController::class, 'preSignup']);
Route::middleware('api')->group(function () {
    Route::get('get-user', [UserController::class, 'getLoggedInUser']);
    Route::post('add-user-service', [UserController::class, 'addUserServices']);
    Route::get('get-services', [UserController::class, 'addGetServices']);
    Route::get('get-forwarders', [UserController::class, 'getForwarders']);
    Route::get('get-forwarder/{user}', [UserController::class, 'getForwarder']);
    Route::post('add-forwarders', [UserController::class, 'addForwarders']);
    Route::get('get-shippers', [UserController::class, 'getShippers']);
    Route::post('add-shipper', [UserController::class, 'addShipper']);
    Route::get('get-user/{user}/{role_id}', [UserController::class, 'getUser']);
    //    Route::get('/shipper-validation/{user}',[UserController::class,'us'])
    Route::post('add-extended-forwarder', [InquiryController::class, 'addExtendedForwarders']);
    Route::get('consignee/get-inquires', [InquiryController::class, 'getConsigneeInquires']);
    Route::get('consignee/get-inquiry-rate/{id}', [InquiryController::class, 'getConsigneeInquiryRate']);
    Route::get('consignee/get-inquiry-accepted-rate/{id}', [InquiryController::class, 'getAcceptedRateConsignee']);
    Route::post(
        'consignee/acceptance/{inquiryId}/{inquiryRateId}',
        [InquiryController::class, 'consigneeInquiryAcceptRate']
    );

    Route::post(
        'inquiry-extended-rate-accept/{id}',
        [InquiryController::class, 'extendedForwarderRateAcceptance']
    );



    Route::get('get-accepted-inquiries', [InquiryController::class, 'getAcceptedInquiries']);

    Route::get('get-countries', [AddressController::class, 'getCountries']);
    Route::get('get-states/{id}', [AddressController::class, 'getStates']);
    Route::get('get-cities/{id}', [AddressController::class, 'getCities']);

    Route::post('inquiry-create', [InquiryController::class, 'create']);

    Route::prefix('forwarder')->group(function () {
        Route::get('/get-inquires', [InquiryController::class, 'getInquires']);
        Route::get('/get-accepted-inquires', [InquiryController::class, 'getForwarderAcceptedInquires']);
        Route::post('/add-rate/{id}', [InquiryController::class, 'inquiryAddRate']);
        Route::get('/get-rate/{id}', [InquiryController::class, 'getInquiryRate']);
        Route::get('/extra-rate/{id}', [InquiryController::class, 'getExtraRate']);
        Route::get('/get-inquiry-accepted-rate/{id}', [InquiryController::class, 'getAcceptedRateForwarder']);
        Route::get('/vessel-departed/{id}', [InquiryController::class, 'inquiryVesselDeparted']);
    });

    Route::post('inquiry/add-document', [InquiryController::class, 'addDocument']);
    Route::get('inquiry/document/{id}', [InquiryController::class, 'getDocuments']);
    Route::post('inquiry/change-status', [InquiryController::class, 'inquiryChangeStatus']);

    Route::get('/document/{id}', [InquiryController::class, 'getDocument']);
    Route::post('/update-document/{id}', [InquiryController::class, 'updateDocument']);

    Route::apiResource('service', ServiceController::class);
    Route::apiResource('sea-port', SeaPortController::class);
    Route::apiResource('container', ContainerController::class);
    Route::apiResource('carrier', CarrierController::class);
    Route::apiResource('role', RoleController::class);
    Route::apiResource('permission', PermissionController::class);
});
