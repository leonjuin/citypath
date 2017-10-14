<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSetting extends Model
{
	use SoftDeletes;

    public $table = 't0104_user_setting';
    protected $dates = [];
    protected $fillable = ['user_id', 'language', 'currency'];
    public $timestamps = true;

   
    public function user() {
    	return $this->hasOne('App\Models\User', 'id', 'user_id'); 
    } 
}
