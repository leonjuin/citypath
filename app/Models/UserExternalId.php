<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserExternalId extends Model
{
	use SoftDeletes;

    public $table = 't0102_user_external_id';
    protected $dates = [];
    protected $fillable = ['user_id', 'facebook', 'google'];
    public $timestamps = true;

    public function updateFacebook($providerUser) {
    	$user = UserFacebook::find($providerUser->id);
    	if(!$user){
    		$user = UserFacebook::create([
    			'id' => $providerUser->id,
    			'name' => $providerUser->name,
    			'email' => $providerUser->email,
    		]);
    	}

    	$user->update([
			'name' => $providerUser->name,
			'email' => $providerUser->email,
    	]);

    	return;
    }

    public function updateGoogle($providerUser) {
    	$user = UserGoogle::find($providerUser->id);
    	if(!$user){
    		$user = UserGoogle::create([
    			'id' => $providerUser->id,
    			'name' => $providerUser->name,
    			'email' => $providerUser->email,
    		]);
    	}

    	$user->update([
			'name' => $providerUser->name,
			'email' => $providerUser->email,
    	]);

    	return;    	
    }

    public function user() {
    	return $this->hasOne('App\Models\User', 'id', 'user_id'); 
    } 

    public function facebookProfile() {
    	return $this->hasOne('App\Models\UserFacebook', 'id', 'facebook'); 
    } 

    public function googleProfile() {
    	return $this->hasOne('App\Models\UserGoogle', 'id', 'google'); 
    }                
}
