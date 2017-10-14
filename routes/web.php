<?php

require(base_path() . '/routes/web/user.php');
require(base_path() . '/routes/web/admin.php');

Route::group(['namespace' => 'Admin'], function(){
	Route::get('/admin/register/by/{provider}', 'Auth\RegisterController@externalRegistration');
});

Route::get('/test', function(){
	
	// factory(App\Models\UserSubscription::class, 20)-
});

/*
	
	// Admin Set
	factory(App\Models\Admin::class, 20)->create()->each(
		function($admin) {
			factory(App\Models\AdminExternalId::class)->create(['admin_id' => $admin->id]);
	});

	// External Admin Request
		factory(App\Models\AdminExternalRequest::class, 20)->create();


	// User set
	factory(App\Models\User::class, 20)->create()->each(
		function($user) {
			factory(App\Models\UserExternalId::class)->create(['user_id' => $user->id]);
			factory(App\Models\UserSetting::class)->create(['user_id' => $user->id]);
			factory(App\Models\UserSubscription::class)->create(['user_id' => $user->id]);
	});

*/