<?php

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

Auth::routes();

Route::group(['middleware'=>'auth'], function() {

    Route::get('/', function () {
        if(auth()->user()->role_id == 1) {
            define('IS_ADMIN',true);
            define('IS_OPERATOR',false);
        }else{
            define('IS_ADMIN',false);
            define('IS_OPERATOR',true);
        }
		return view('dashboard');
    });

    // Vehicle
    Route::group(['prefix' => 'vehicle'], function () {
        Route::get('/', ['as' => 'vehicle_index', 'uses' => 'VehicleController@index']);
        Route::get('create', ['as' => 'vehicle_create', 'uses' => 'VehicleController@create']);
        Route::post('store', ['as' => 'vehicle_store', 'uses' => 'VehicleController@store']);
        Route::get('{id}/edit', ['as' => 'vehicle_edit', 'uses' => 'VehicleController@edit']);
        Route::patch('{id}/update', ['as' => 'vehicle_update', 'uses' => 'VehicleController@update']);
        Route::post('delete/{id}', ['as' => 'vehicle_delete', 'uses' => 'VehicleController@destroy']);
    });

    // Country
    Route::group(['prefix' => 'country'], function () {
        Route::get('/', ['as' => 'country_index', 'uses' => 'CountryController@index']);
        Route::get('create', ['as' => 'country_create', 'uses' => 'CountryController@create']);
        Route::post('store', ['as' => 'country_store', 'uses' => 'CountryController@store']);
        Route::get('{id}/edit', ['as' => 'country_edit', 'uses' => 'CountryController@edit']);
        Route::patch('{id}/update', ['as' => 'country_update', 'uses' => 'CountryController@update']);
        Route::post('delete/{id}', ['as' => 'country_delete', 'uses' => 'CountryController@destroy']);
    });

    // State
    Route::group(['prefix' => 'state'], function () {
        Route::get('/', ['as' => 'state_index', 'uses' => 'StateController@index']);
        Route::get('create', ['as' => 'state_create', 'uses' => 'StateController@create']);
        Route::post('store', ['as' => 'state_store', 'uses' => 'StateController@store']);
        Route::get('{id}/edit', ['as' => 'state_edit', 'uses' => 'StateController@edit']);
        Route::patch('{id}/update', ['as' => 'state_update', 'uses' => 'StateController@update']);
        Route::post('delete/{id}', ['as' => 'state_delete', 'uses' => 'StateController@destroy']);
    });

    // city
    Route::group(['prefix' => 'city'], function () {
        Route::get('/', ['as' => 'city_index', 'uses' => 'CityController@index']);
        Route::get('create', ['as' => 'city_create', 'uses' => 'CityController@create']);
        Route::post('store', ['as' => 'city_store', 'uses' => 'CityController@store']);
        Route::get('{id}/edit', ['as' => 'city_edit', 'uses' => 'CityController@edit']);
        Route::patch('{id}/update', ['as' => 'city_update', 'uses' => 'CityController@update']);
        Route::post('delete/{id}', ['as' => 'city_delete', 'uses' => 'CityController@destroy']);
    });

    // driver
    Route::group(['prefix' => 'driver'], function () {
        Route::get('/', ['as' => 'driver_index', 'uses' => 'DriverController@index']);        
        Route::get('create', ['as' => 'driver_create', 'uses' => 'DriverController@create']);
        Route::post('store', ['as' => 'driver_store', 'uses' => 'DriverController@store']);
        Route::get('{id}/edit', ['as' => 'driver_edit', 'uses' => 'DriverController@edit']);
        Route::patch('{id}/update', ['as' => 'driver_update', 'uses' => 'DriverController@update']);
        Route::post('delete/{id}', ['as' => 'driver_delete', 'uses' => 'DriverController@destroy']);
    });
    Route::get('unapproved_driver_index', ['as' => 'unapproved_driver_index', 'uses' => 'DriverController@unApprovedDrivers']);

    // operator
    Route::group(['prefix' => 'operator'], function () {
        Route::get('/', ['as' => 'operator_index', 'uses' => 'OperatorController@index']);        
        Route::get('create', ['as' => 'operator_create', 'uses' => 'OperatorController@create']);
        Route::post('store', ['as' => 'operator_store', 'uses' => 'OperatorController@store']);
        Route::get('{id}/edit', ['as' => 'operator_edit', 'uses' => 'OperatorController@edit']);
        Route::patch('{id}/update', ['as' => 'operator_update', 'uses' => 'OperatorController@update']);
        Route::post('delete/{id}', ['as' => 'operator_delete', 'uses' => 'OperatorController@destroy']);
    });

    //Common routes
    Route::get('get-state','CommonController@getState')->name('get-state');
    Route::get('get-cities','CommonController@getCities')->name('get-cities');
    Route::post('driver-status-change/{id}','DriverController@driverStatusChange')->name('driver-status-change');
    Route::post('operator-status-change/{id}','OperatorController@operatorStatusChange')->name('operator-status-change');
    
    Route::get('profile_view','UserController@profileView')->name('profile_view');
    Route::post('profile_update/{id}','UserController@profileUpdate')->name('profile_update');
});

//Operator Route
Route::get('operator_sign_up','OperatorController@signup')->name('operator_sign_up');
Route::post('operator_sign_up','OperatorController@store')->name('operator_sign_up');