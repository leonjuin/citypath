<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetsUser extends Model
{
    public $table = 't9101_password_resets_user';
    protected $fillable = ['email', 'token', 'created_at'];
}
