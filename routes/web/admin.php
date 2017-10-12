<?php

use App\Models\Admin;

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/password/change', 'Auth\ChangePasswordController@showChangePasswordForm');
    Route::post('/password/change', 'Auth\ChangePasswordController@handleChangePassword');
    Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');

    Route::name('admin-auth-provider-login')->get('/auth/{provider}/login', 'Auth\LoginController@providerLogin');
    Route::name('admin-auth-provider-bind')->get('/auth/{provider}/bind', 'Auth\LoginController@providerBind');
    Route::middleware('guest:web_admin')->get('/', 'PageController@showNgGeneral');
    Auth::routes();
    Route::get('/logout', 'Auth\LoginController@logout');

    Route::get('/templates/{name}', 'PageController@ngTemplate');

    Route::group(['middleware' => 'auth:web_admin'], function () {
        Route::get('/', 'PageController@showNgGeneral');
        Route::get('/password/change', 'PageController@showNgGeneral');
    });

    //special api that need web session/cookie on
    Route::get('/api/auth/login/facebook', 'Auth\LoginController@facebook');  
    
    //HIDE
    Route::group(['prefix' => 'hide'], function () {
        //manual create personal token
        Route::get('/token/create', function(Request $request){
            $user = Admin::findOrFail(1);
            $user = Auth::login($user, true);
            $user = Auth::user();
 
            // Creating a token without scopes...
            $token = $user->createToken('Crowbar! Personal Access Client')->accessToken;          
            die($token);
        });        
    });  
});