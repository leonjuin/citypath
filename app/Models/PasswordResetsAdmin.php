<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetsAdmin extends Model
{
    public $table = 't9011_password_resets_admin';
    protected $fillable = ['email', 'token', 'created_at'];
}
