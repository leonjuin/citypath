<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthAccessTokens extends Model
{
    public $table = 't8000_oauth_access_tokens';
    protected $fillable = ['user_id', 'client_id', 'name', 'scopes', 'revoked', 'expires_at'];
    public $timestamps = true;
}