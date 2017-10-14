<?php

use Illuminate\Http\Request;

require(base_path() . '/routes/api/user.php');
require(base_path() . '/routes/api/admin.php');

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/