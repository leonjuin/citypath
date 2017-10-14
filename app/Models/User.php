<?php

namespace App\Models;

use DB;
use Carbon\Carbon;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\UserExternalId;
use App\Models\UserCountry;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 't0101_user';

    protected $fillable = [
        'type', 'name', 'email', 'username', 'password',
    ];

    protected $hidden = [
        'remember_token', 'updated_at', 'deleted_at', 'password'
    ];

    public function createBase($externalIds = [], $settings = []){
        $ext = UserExternalId::create([
            'user_id' => $this->id,
        ]);
        foreach($externalIds as $key => $value){
            $ext->$key = $value;
        }    
        $ext->save();

        $setting = UserSetting::create([
            'user_id' => $this->id
        ]);
        foreach($settings as $key => $value){
            $setting->$key = $value;
        }    
        $setting->save();            
    }

    public function usernameAvailability($username){
        return !User::where('username', $username)->where('id', '<>', $this->id)->first();
    }   

    public function externalId() {
        return $this->hasOne('App\Models\UserExternalId', 'user_id', 'id');
    }
  
}
