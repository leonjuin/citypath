<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogGeneral extends Model
{
	use SoftDeletes;

    public $table = 't9401_log_general';
    protected $dates = [];
    protected $fillable = ['level_name', 'message', 'environment'];
    public $timestamps = true;
}
