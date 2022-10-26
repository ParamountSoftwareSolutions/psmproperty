<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'v1', 'namespace' => 'Api'], function(){
    Route::group(['prefix'=> 'auth'], function(){
        //Route::post('/register', 'AuthController@register');
        Route::post('/login', 'AuthController@login');
        Route::post('/forget-password', 'AuthController@forgetPassword');
    });

    Route::group(['middleware' => ['auth:api', 'role:user', 'app_user']], function(){
        Route::get('dashboard', 'DashboardController@index');
        Route::get('profile', 'AuthController@profile');
        Route::post('update-profile', 'AuthController@updateProfile');
        //Route::get('projects', 'BuildingController@index');
        Route::get('installment/details', 'InstallmentController@index');
        Route::post('installment/update/{id}', 'InstallmentController@update');
        Route::post('other_installment/update/{id}', 'InstallmentController@updateOther');
        Route::get('payment/history', 'SalesController@history');
        Route::post('possession_request', 'PossessionController@create');
        Route::get('receipt', 'ReceiptController@index');

        Route::post('logout', 'AuthController@logout');
    });

    /*Route::group(['middleware' => ['auth:api', 'role:guest']], function(){
        Route::get('/dashboard', 'DashboardController@index');
        Route::get('/profile', 'AuthController@profile');
        Route::get('logout', 'AuthController@logout');
    });*/
    Route::get('about', 'PageController@about');
    Route::get('term&condition', 'PageController@termCondition');
    Route::get('privacy-policy', 'PageController@privacyPolicy');
    Route::get('faq', 'FaqController@index');


    Route::get('/societies', 'HomeController@societies');
    Route::get('/society-details', 'HomeController@societyDetails');
});

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    return 'Configuration cache cleared! <br> Configuration cached successfully!';
});
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    return 'Application cache cleared!';
});
Route::get('/view-clear', function () {
    Artisan::call('view:clear');
    return 'Application cache cleared!';
});

Route::group(['prefix'=>'v1/property', 'namespace' => 'Api\Building'], function(){
    Route::group(['prefix'=> 'auth'], function(){
        //Route::post('/register', 'AuthController@register');
        Route::post('/login', 'AuthBuildingController@login');
        Route::post('/forget-password', 'AuthBuildingController@forgetPassword');
    });

    Route::group(['middleware' => ['auth:api', 'role:user', 'building_app_user']], function(){
        Route::get('dashboard', 'DashboardController@index');
        Route::get('filter/{building_id}/{type}', 'DashboardController@filter');
        Route::get('filter/data/{building_id}/{floor_detail_id}/{type}', 'DashboardController@filter_data');
        Route::get('update/{building_id}/{id}', 'DashboardController@update_detail');
        Route::get('profile', 'AuthBuildingController@profile');
        Route::post('update-profile', 'AuthBuildingController@updateProfile');
        Route::post('update-password', 'AuthBuildingController@updatePassword');
        Route::get('buildings', 'BuildingController@index');
        Route::get('properties', 'BuildingController@property');
        Route::get('single-property/{id}', 'BuildingController@single_property');
        Route::get('single-building/{id}', 'BuildingController@single_building');
        Route::get('installment/details', 'InstallmentController@index');
        Route::get('installment/detail/{id}','InstallmentController@show');
        Route::get('installment/more_detail/{id}','InstallmentController@installment_detail');
        Route::post('installment/update/{id}', 'InstallmentController@store');
        Route::post('other_installment/update/{id}', 'InstallmentController@updateOther');
        Route::get('payment/history', 'SalesController@history');
        Route::post('request', 'BookingController@request');

        /*Route::post('transfer_request', 'BookingController@transfer');
        Route::post('file_request', 'BookingController@file');*/
        Route::get('reserve_building_detail/{building_id}', 'BookingController@reserve_building_detail');
        Route::post('reserve_request', 'BookingController@reserve');
        Route::get('receipt', 'ReceiptController@index');

        Route::get('about', 'PageController@about');
        Route::get('term&condition', 'PageController@termCondition');
        Route::get('privacy-policy', 'PageController@privacyPolicy');
        Route::get('faq', 'PageController@faq');

        Route::post('logout', 'AuthBuildingController@logout');
    });

    Route::group(['namespace' => 'Guest'], function() {
        Route::get('dashboard/{app_key}', 'DashboardController@index');
        Route::get('filter/{app_key}/{building_id}/{type}', 'DashboardController@filter');
        Route::get('filter/data/{app_key}/{building_id}/{floor_detail_id}/{type}', 'DashboardController@filter_data');
        Route::get('update/{app_key}/{building_id}/{id}', 'DashboardController@update_detail');
        Route::get('buildings/{app_key}', 'DashboardController@building_all');
        Route::get('single-building/{app_key}/{id}', 'DashboardController@single_building');

        Route::get('reserve_building_detail/{app_key}/{building_id}', 'DashboardController@reserve_building_detail');
        Route::post('reserve_request', 'DashboardController@reserve');
        Route::get('receipt', 'DashboardController@index');

        Route::get('about/{app_key}', 'PageController@about');
        Route::get('term&condition/{app_key}', 'PageController@termCondition');
        Route::get('privacy-policy/{app_key}', 'PageController@privacyPolicy');
        Route::get('faq/{app_key}', 'PageController@faq');
    });
});


