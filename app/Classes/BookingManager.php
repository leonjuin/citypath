<?php
namespace App\Classes;

use DB;
use Exception;
use App\Models\User;
use App\Models\Room;
use App\Models\RoomRate;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Payment;
use App\Models\PaymentFree;
use App\Models\Order;
use App\Models\BookingContact;
use App\Models\RunningNumber;
use App\Classes\RoomRateManager;
use Carbon\Carbon;

use Illuminate\Database\QueryException;

class BookingManager
{
	function __construct() {
	}

    public function getBookingByStatus($status){
        $today = Carbon::now();
        $result = [];

        switch($status){
            case 'all': break;
            case 'upcoming': $result = $this->getUpcomingBooking(); break;
            case 'staying': $result = $this->getStayingBooking(); break;
            case 'future': $result = $this->getFutureBooking(); break;
        }

        return $result;
    }

    public function getStayingBooking(){
        $sql = "
            SELECT 
                b.*,
                bc.`first_name`,
                bc.`last_name`,
                bc.`company_name`,
                b_item.`checked_in`,
                b_item.`checked_out`
                FROM `t0321_booking` b, `t0323_booking_contact` bc, `t0322_booking_item` b_item
                    WHERE b.`id` = bc.`booking_id`
                    AND b.`id` = b_item.`booking_id`
                    AND b.`check_in` <= CURDATE()
                    AND b.`check_out` > CURDATE()
                    AND b_item.`checked_in` is not null
                    AND b_item.`checked_out` is null
                    GROUP BY b.`id`
        ";

        return DB::select($sql);
    }

    public function getBookingByDateRange($from, $to){
        $sql = "
            SELECT 
                b.*,
                bc.`first_name`,
                bc.`last_name`
                FROM `t0321_booking` b, `t0323_booking_contact` bc
                    WHERE b.`id` = bc.`booking_id` 
                    AND b.`check_out` >= :dateFrom
                    AND b.`check_out` <= :dateTo
        ";

        return DB::select($sql,[
            'dateFrom' => $from,
            'dateTo' => $to
        ]);
    }

    public function getBookingReportByDateRange($from, $to){
        $sql = "
            SELECT 
                SUM(b_item.`total_paid`) AS total_revenue,
                SUM(b_item.`total_room`) AS total_room,
                SUM(b_item.`total_adults` + b_item.`total_children`) AS total_guest
                FROM `t0322_booking_item` b_item
                    WHERE b_item.`check_in_date` >= :dateFrom
                    AND b_item.`check_in_date` <= :dateTo
        ";

        return DB::select($sql,[
            'dateFrom' => $from,
            'dateTo' => $to
        ]);
    }

    public function getBookingByBookingRef($bookingRef){
        $sql = "
            SELECT 
                b.*,
                bc.`first_name`,
                bc.`last_name`
                FROM `t0321_booking` b, `t0323_booking_contact` bc
                    WHERE b.`id` = bc.`booking_id` 
                    AND b.`booking_ref` = :bookingRef
        ";

        return DB::select($sql,[
            'bookingRef' => $bookingRef
        ]);
    }

    public function getBookingHistoryItems($bookingId){
        $sql = "
            SELECT
                b_item.*,
                r.`name` AS `room_name`
                FROM `t0322_booking_item` b_item, `t0301_room` r
                    WHERE b_item.`room_id` = r.`id`
                    AND b_item.`booking_id` = :bookingId
        ";

        return DB::select($sql, [
            'bookingId' => $bookingId
        ]);
    }

    public function getUpcomingBooking(){
        $sql = "
            SELECT 
                b.*,
                bc.`first_name`,
                bc.`last_name`,
                bc.`company_name`,
                b_item.`checked_in`,
                b_item.`checked_out`
                FROM `t0321_booking` b, `t0323_booking_contact` bc, `t0322_booking_item` b_item
                    WHERE b.`id` = bc.`booking_id`
                    AND b.`id` = b_item.`booking_id`
                    AND b.`check_in` <= CURDATE()
                    AND b.`check_out` > CURDATE()
                    AND b_item.`checked_in` is null
                    AND b_item.`checked_out` is null
                    GROUP BY b.`id`
        ";

        return DB::select($sql);
    }

    public function getFutureBooking(){
        $sql = "
            SELECT 
                b.*,
                bc.`first_name`,
                bc.`last_name`,
                bc.`company_name`
                FROM `t0321_booking` b, `t0323_booking_contact` bc
                    WHERE b.`id` = bc.`booking_id`
                    AND b.`check_in` > CURDATE()
        ";

        return DB::select($sql);
    }

    public function getBookingItemsWithRoom($bookingId){
        $sql = "
            SELECT
                b_item.*,
                r.`name` AS `room_name`
                FROM `t0322_booking_item` b_item, `t0301_room` r
                    WHERE b_item.`room_id` = r.`id`
                    AND b_item.`booking_id` = :bookingId
        ";

        return DB::select($sql, [
            'bookingId' => $bookingId
        ]);
    }

    public function updateSingleStatus($bookingData, $status){
        foreach($bookingData['ids'] as $id){
            $bookingItem = BookingItem::find($id);

            switch($status){
                case 'staying': $bookingItem->checked_in = Carbon::now(); break;
                case 'closed': $bookingItem->checked_out = Carbon::now(); break;
            }

            $bookingItem->save();
        }
    }

    public function updateMultipleStatus($bookingId, $status){
        switch($status){
            case 'staying': 
                BookingItem::where('booking_id', $bookingId)
                    ->update(['checked_in' => Carbon::now()]);
                break;
            case 'closed':
                BookingItem::where('booking_id', $bookingId)
                    ->update(['checked_out' => Carbon::now()]);
                break;
        }
        
    }

    public function generateBookingRef(){
        $runningNumber = RunningNumber::find(1);

        $currentBookingRefIdRunningNumber = $runningNumber->booking_ref_id;
        $currentUserIdRunningNumber = $runningNumber->user_id;
        // step 1: Current booking ref id(x) (2x + 1) then base 36
        // step 2: Current booking ref id(x) (x % 36) then base 36
        // step 3: Step 2 result + Step 1 result

        $calculatedBookingRefId = 2 * ($currentBookingRefIdRunningNumber) + 1;
        $base36CalculatedBookingRefId = base_convert($calculatedBookingRefId, 10, 36);

        $calculatedModBookingRefId = $currentBookingRefIdRunningNumber % 36;
        $base36CalculatedModBookingRefId = base_convert($calculatedModBookingRefId, 10, 36);

        $firstDigit = $base36CalculatedModBookingRefId;
        $lastFiveDigits = str_pad($base36CalculatedBookingRefId, 5, "0", STR_PAD_LEFT);

        $bookingRef = $firstDigit . $lastFiveDigits;

        RunningNumber::find(1)->update([
            'booking_ref_id' => $currentBookingRefIdRunningNumber + 1,
            'user_id' => $currentUserIdRunningNumber + 1
        ]);

        return $bookingRef;
    }

    
}