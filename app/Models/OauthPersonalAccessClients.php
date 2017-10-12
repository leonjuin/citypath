<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OauthPersonalAccessClients extends Model
{
    public $table = 't8000_oauth_personal_access_clients';
    protected $fillable = ['client_id'];
    public $timestamps = true;
}