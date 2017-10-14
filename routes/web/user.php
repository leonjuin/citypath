<?php

Route::group(['prefix' => '', 'namespace' => 'User', 'middleware' => 'web'], function () {

	Route::get('/', 'PageController@index');
	Route::get('/login/facebook', 'Auth\LoginController@loginWithFacebook');
	Route::get('/login/google', 'Auth\LoginController@loginWithGoogle');
});

