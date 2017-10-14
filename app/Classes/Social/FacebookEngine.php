<?php
namespace App\Classes\Social;

use DB;
use Exception;

use Illuminate\Database\QueryException;

class FacebookEngine
{
	function __construct() {
		// initialize facebook object
		$this->facebook = new \Facebook\Facebook([
            'app_id' => config('app.social.facebook.app_id'),
            'app_secret' => config('app.social.facebook.app_secret'),
            'default_graph_version' => config('app.social.facebook.graph_version')
        ]);
	}

	function login(){
		dd('please handle facebook login');
	}

}