<?php
namespace App\Classes;

use DB;
use Exception;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomRate;
use App\Models\RunningNumber;

use Illuminate\Database\QueryException;

class RoomRateManager
{
	//public $company;

	function __construct() {
		//$this->company = Company::findOrFail($companyId);
	}

    public function check($from, $to){
        $sql = "
            SELECT
                t.`sdate`,
                t.`room_id`, 
                IFNULL(r1.`rate_per_room`, t.`rate_default`) AS `rate_per_room`,
                IFNULL(r1.`version`, 0) AS `version`,
            FROM (
                SELECT 
                    d.`sdate`,
                    r0.`room_id`, 
                    r0.`rate_per_room` AS `rate_default`
                FROM 
                (
                    SELECT 
                        CURDATE() + 
                        INTERVAL (0
                            + r0.`val` * POW(10, 0) 
                            + r1.`val` * POW(10, 1) 
                            + r2.`val` * POW(10, 2)
                        ) DAY AS `sdate`
                    FROM (
                        SELECT 0 AS val UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
                    ) AS r0
                    CROSS JOIN 
                    (
                        SELECT 0 AS val UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
                    ) AS r1
                    CROSS JOIN 
                    (
                        SELECT 0 AS val UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9
                    ) AS r2 
                ) d,    
                `t0311_room_rate` r0
                WHERE 1
                    AND r0.`version` = 0
                    AND r0.`deleted_at` IS NULL
                    AND d.`sdate` >= :from
                    AND d.`sdate` < :to
                ORDER BY 
                    d.`sdate` ASC,
                    r0.`room_id` ASC
            ) t
            LEFT JOIN (
                SELECT 
                    r.`room_id`, r.`target_date`, r.`rate_per_room`, r.`version`
                FROM `t0311_room_rate` r
                LEFT JOIN `t0311_room_rate` _r
                    ON( 1
                        AND r.`room_id` = _r.`room_id` 
                        AND _r.`target_date` = r.`target_date`
                        AND _r.`version` > r.`version`
                        AND _r.`version` > 0
                        AND _r.`seasonal` = 1
                    )
                WHERE 1
                    AND r.`version` > 0
                    AND r.`seasonal` = 1
                    AND _r.`id` IS NULL
                    AND r.`deleted_at` IS NULL
                GROUP BY r.`room_id`, r.`target_date`
            ) r1
                ON( r1.`room_id` = t.`room_id` AND r1.`target_date` = t.`sdate`)
            ORDER BY 
                t.`sdate` ASC,
                t.`room_id` ASC
        ";

        return DB::select($sql, [
            'from' => $from, 
            'to' => $to, 
        ]);
    }

    public static function getRoomRateObject($roomRates, $date, $roomId, $checkInDate){
        foreach($roomRates as $rate){
            if($rate["room_id"] == $roomId && $rate["date"] == $checkInDate){
                return $rate;
            }
        }
    }

    public static function createOrUpdateRoomRate($checkInDate, $roomId, $roomRate, $rateVersion){

        $defaultRate = RoomRate::where('room_id', $roomId)
                ->where('version', 0)
                ->first();
        $runningNumber = RunningNumber::find(1);

        if($rateVersion){
            $roomRates = RoomRate::where('room_id', $roomId)
                ->where('target_date', $checkInDate)
                ->where('rate_per_room', $roomRate)
                ->where('version', $rateVersion)
                ->first();

            if($roomRates){
                $roomRates->update([
                    'total_booked' => $roomRates->total_booked + 1
                ]);
                return;
            }
        }else{
            $roomRates = RoomRate::where('room_id', $roomId)
                ->where('target_date', $checkInDate)
                ->where('rate_per_room', $roomRate)
                ->orderBy('seasonal', 'desc')
                ->orderBy('version', 'desc')
                ->first();

            if($roomRates){
                $roomRates->update([
                    'total_booked' => $roomRates->total_booked + 1
                ]);
                return;
            }
        }

        RoomRate::create([
            'room_id' => $roomId,
            'target_date' => $checkInDate,
            'rate_per_room' => $roomRate,
            'max_room' => $defaultRate->max_room,
            'total_booked' => 1,
            'version' => $runningNumber->rate_version,
            'seasonal' => 0
        ]);

        $runningNumber->update(['rate_version' => $runningNumber->rate_version + 1]);
    }

    public function getAvailability($from, $to){
        $sql = "
            SELECT *
                FROM `t0311_room_rate` rr
                    GROUP BY rr.`target_date`, rr.`room_id`
        ";

        return DB::select($sql);
        
        return DB::select($sql, [
            'from' => $from, 
            'to' => $to, 
        ]);
    }
 	
}