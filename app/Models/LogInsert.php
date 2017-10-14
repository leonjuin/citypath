<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogInsert extends Model
{

    public $table = 't9411_log_insert';
    protected $fillable = ['user_type', 'user_id', 'table_name', 'table_id'];

    //Create new log
    public static function createLog($table_name, $table_id){
        //Get currrent user's ID
        $id = Auth::user()->id;

        //Check if current user is User or Admin
        if (Auth::user()->getTable() == 't0101_user') {
            $type = "User";
        } else{
            $type = "Admin";
        }

        //Insert data into DB
        $log_insert = LogInsert::create([
            'user_type'     => $type,
            'user_id'  => $id,
            'table_name'  => $table_name,
            'table_id'  => $table_id
        ]);
    }
}
