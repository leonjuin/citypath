<?php

namespace App\Models;

use DB;
use App\Models\Admin;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\AdminExternalId;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Input;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 't0011_admin';

    protected $fillable = [
        'type', 'name', 'email', 'username','type', 'password',
    ];

    protected $hidden = [
        'remember_token', 'updated_at', 'deleted_at',
    ];

    public function createBase(){
        $ext = AdminExternalId::create([
            'admin_id' => $this->id,
        ]);
    }

    public function externalId() {
        return $this->hasOne('App\Models\AdminExternalId', 'user_id', 'id');
    }    
}