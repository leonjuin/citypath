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
use App\Models\Order;
use App\Models\BookingContact;
use App\Models\RunningNumber;
use App\Classes\RoomRateManager;
use App\Classes\BookingManager;
use Carbon\Carbon;

use Illuminate\Database\QueryException;

class OrderManager
{

	function __construct() {
        $this->bookingManager = new BookingManager();
	}

    public function createOrder($request){
        $order = null;

        $totalNights = Carbon::parse($request->check_out)->diffInDays(Carbon::parse($request->check_in));
        $currentUserId = RunningNumber::find(1)->user_id;
        $bookingRef = $this->bookingManager->generateBookingRef();

        DB::transaction(function() use($request, &$order, $currentUserId, $bookingRef, $totalNights){

            $order = Order::create([
                'type' => 'booking',
                'type_payment' => $request->type_payment,
                'payment_id' => null,
                'total_amount' => $request->total_amount,
                'status' => 'ordered',
                'order_at' => Carbon::now()
            ]);

            $user = User::create([
                'type' => 'guest',
                'name' => $request->first_name,
                'username' => $currentUserId . $request->first_name,
                'email' => $request->email
            ]);

            $booking = Booking::create([
                'order_id' => $order->id,
                'booking_ref' => $bookingRef,
                'user_id' => $user->id,
                'check_in' => Carbon::parse($request->check_in),
                'check_out' => Carbon::parse($request->check_out),
                'total_room' => $request->total_rooms,
                'total_guest' => $request->total_guests,
                'guest_remark' => $request->guest_remark
            ]);

            $bookingContact = BookingContact::create([
                'booking_id' => $booking->id,
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name' => ($request->company_name)?$request->company_name:null,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'contact_no' => $request->phone
             ]);

            foreach($request->booking_data as $bookingItem){
                if($bookingItem["selected_quantity"]){
                    for($counter = 0; $counter < sizeof($bookingItem["rooms"]); $counter++){
                        for($nights = 0; $nights < $totalNights; $nights++){
                            $checkInDate = substr(Carbon::parse($request->check_in)->addDays($nights)->toDateTimeString(),0,10);
                            $checkOutDate = substr(Carbon::parse($request->check_in)->addDays($nights + 1)->toDateTimeString(),0,10);

                            $rate = RoomRateManager::getRoomRateObject($request->room_rates, $checkInDate, $bookingItem["room_id"], $checkInDate);

                            RoomRateManager::createOrUpdateRoomRate($checkInDate, $bookingItem["room_id"], $rate["room_rate"], $rate["rate_version"]);
                            BookingItem::create([
                                'booking_id' => $booking->id,
                                'booking_ref' => $bookingRef,
                                'user_id' => $user->id,
                                'room_id' => $bookingItem["room_id"],
                                'check_in_date' => $checkInDate,
                                'check_out_date' => $checkOutDate,
                                'total_adults' => $bookingItem["rooms"][$counter]["adults"],
                                'total_children' => $bookingItem["rooms"][$counter]["children"],
                                'total_room' => 1,
                                'total_paid' => $rate["room_rate"],
                                'rate_version' => $rate["rate_version"],
                                'status' => 'upcoming'
                            ]);

                        }
                    }
                }
            }
            return $order;
        });

        return $order;
    } 	
}