<?php

Route::group(['prefix' => '', 'namespace' => 'User', 'middleware' => 'web'], function () {

	Route::get('/', 'PageController@index');

});

