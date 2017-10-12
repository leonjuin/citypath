<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'User\Api'], function () {
	Route::get('/', 'Controller@index');
});


Route::group(['namespace' => 'User\Api', 'prefix' => 'hide'], function () {

});