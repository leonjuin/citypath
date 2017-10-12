<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthAuthCodes extends Model
{
    public $table = 't8000_oauth_auth_codes';
    protected $fillable = ['user_id', 'client_id', 'scopes', 'revoked', 'expires_at'];
    public $timestamps = true;
}