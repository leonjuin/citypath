<?php

use App\Models\Admin;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

  Route::middleware('guest:web_admin')->get('/', 'PageController@showNgGeneral');
  Route::get('/password/change', 'Auth\ChangePasswordController@showChangePasswordForm');
  Route::post('/password/change', 'Auth\ChangePasswordController@handleChangePassword');
  Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');

  Route::name('admin-auth-provider-login')->get('/auth/{provider}/login', 'Auth\LoginController@providerLogin');
  Auth::routes();

  Route::get('/logout', 'Auth\LoginController@logout');

  Route::get('/templates/{name}', 'PageController@ngTemplate');

  Route::group(['middleware' => 'auth:web_admin'], function () {
    Route::get('/', 'PageController@showNgGeneral');
    Route::get('/password/change', 'PageController@showNgGeneral');
  });

  //HIDE
  Route::group(['prefix' => 'hide'], function () {
    //manual create personal token
    Route::get('/token/create', function(Request $request){
      $user = Admin::findOrFail(1);
      $user = Auth::login($user, true);
      $user = Auth::user();

      // Creating a token without scopes...
      $token = $user->createToken('CityPath! Personal Access Client')->accessToken;          
      die($token);
    });        
  });  
});