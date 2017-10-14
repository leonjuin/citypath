<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminExternalId extends Model
{
	use SoftDeletes;

    public $table = 't0012_admin_external_id';
    protected $dates = [];
    protected $fillable = ['admin_id', 'facebook', 'google'];
    public $timestamps = true;

    //Retrieves admin model 
    public function admin() {
    	return $this->hasOne('App\Models\Admin', 'id', 'admin_id'); 
    }
}
