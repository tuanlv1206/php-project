<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
  Route::get('/', 'HomeController@getIndex');
  Route::post('/', 'HomeController@postIndex');

  Route::get('/redirect/{provider}', 'SocialAuthController@redirect');
  Route::get('/callback/{provider}', 'SocialAuthController@callback');

  // Authentication Routes
  Route::get('dang-nhap','Auth\AuthController@showLoginForm');
  Route::post('dang-nhap', 'Auth\AuthController@login');
  Route::get('thoat', 'Auth\AuthController@logout');

  // Registration Routes
  Route::get('dang-ky', 'Auth\AuthController@showRegistrationForm');
  Route::post('dang-ky', 'Auth\AuthController@register');

  // Password Reset Routes
  Route::get('dat-lai-mat-khau/{token?}', 'Auth\PasswordController@showResetForm');
  Route::post('email-dat-lai-mat-khau', 'Auth\PasswordController@sendResetLinkEmail');
  Route::post('dat-lai-mat-khau', 'Auth\PasswordController@reset');

  // Password change Routes
  Route::group(['middleware' => 'auth'], function() {
    Route::get('doi-mat-khau','UserController@getChange');
    Route::post('/doi-mat-khau', 'UserController@postChange');
  });

  Route::group(['middleware' => 'auth'], function(){
    Route::get('tao-ho-so','ProfileController@create');
    Route::post('dang-ky-ho-so','ProfileController@store');
    Route::get('sua-ho-so','ProfileController@getEdit');
    Route::post('luu-ho-so','ProfileController@postEdit');
    Route::get('tin-dang-chua-duyet','HouseController@unapprovedHouseList');
    Route::match(['post', 'get'], 'xem-tin-de-duyet/{id}', 'HouseController@viewHouseToApprove');
    Route::post('duyet-tin/{id}', 'HouseController@approveHouse');
    Route::get('tin-da-duyet','HouseController@approvedHouseList');
    Route::match(['post', 'get'], 'xem-tin-de-huy-duyet/{id}', 'HouseController@viewApprovedHouse');
    Route::post('huy-duyet-tin/{id}', 'HouseController@disApproveHouse');
  });

  Route::group(['middleware' => 'auth'], function() {
    Route::get('dang-tin', 'HouseController@create');
    Route::post('luu-tin', 'HouseController@store');
    Route::get('sua-tin/{id}', 'HouseController@edit');
    Route::patch('cap-nhat-tin/{id}', 'HouseController@update');
    Route::delete('ajax/deleteHouse', function() {
      return \Response::json(\App\House::deleteHouse(\Input::get('id')));
    });
  });
  Route::get('ha-noi/{slug_id}', 'HouseController@show');
  Route::get('{search_query}/{sort_type?}', 'HomeController@getSearch');
});

Route::post('ajax/getWardsByDistrictId', function() {
  return \Response::json(\App\Ward::getWardsByDistrictId(\Input::get('id')));
});
Route::post('ajax/getStreetsByDistrictId', function() {
  return \Response::json(\App\Street::getStreetsByDistrictId(\Input::get('id')));
});


