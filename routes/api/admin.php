<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Admin\Api', 'prefix' => 'admin'], function () {
	
	Route::get('/', 'Controller@index');
});
