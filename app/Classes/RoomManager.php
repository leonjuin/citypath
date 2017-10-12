<?php
namespace App\Classes;

use DB;
use Exception;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomRate;
use App\Models\RunningNumber;
use App\Models\RoomDailyReport;
use Carbon\Carbon;

use Illuminate\Database\QueryException;

class RoomManager
{
	//public $company;

	function __construct() {
		//$this->company = Company::findOrFail($companyId);
	}

    public function createNinetyDaysRecord(){
        
        $dateNow = Carbon::now()->addDays($counter)->toDateString();
        $rooms = Room::all();
        $roomsMax = RoomRate::where('version', 0)
            ->orderBy('room_id', 'ASC')
            ->get();

        if(RoomDailyReport::all()->count()){

            dd("got");
            return;
        }

        DB::transaction(function(){
            for($counter = 0; $counter < 90; $counter++){

                for($innerCounter = 0; $innerCounter < count($rooms); $innerCounter++){
                    $roomDailyReport = RoomDailyReport::create([
                        'date' => $dateNow,
                        'room_id' => $rooms[$innerCounter]->id,
                        'total_booked' =>  0,
                        'room_available' => $roomsMax[$innerCounter]->max_room,
                        'total_sales' => 0,
                        'total_adults' => 0,
                        'total_children' => 0
                    ]);
                }
            }
        });

        return;
    }

    public function getAllRoomsAvailability($dateFrom, $dateTo){
        $sql = "

        ";

        return DB::select($sql, [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo
        ]);
    }
 	
}