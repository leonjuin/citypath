<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogUpdate extends Model
{
    public $table = 't9412_log_update';
    protected $fillable = ['user_type', 'user_id', 'table_name', 'table_id', 'content_from', 'content_to'];

    public static function updateLog($table_name, $table_id, $content_from, $content_to) {
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
            'table_id'  => $table_id,
            'content_from' => $content_from,
            'content_to' => $content_to
        ]);
    }
}
