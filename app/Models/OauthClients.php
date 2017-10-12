<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthClients extends Model
{
    public $table = 't8000_oauth_clients';
    protected $fillable = ['user_id', 'name', 'secret', 'redirect', 'personal_access_client', 'password_client', 'revoked'];
    public $timestamps = true;
}