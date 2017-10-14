<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthRefreshTokens extends Model
{
    public $table = 't8000_oauth_refresh_tokens';
    protected $fillable = ['access_token_id', 'revoked'];
    public $timestamps = true;
}