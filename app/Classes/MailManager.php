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
use App\Mail\Invoice;
use Mail;

use Illuminate\Database\QueryException;

class MailManager
{
	function __construct($recipient) {
        $this->recipient = $recipient;
	}

    public function sendBookingInvoice($booking){
        $bookingItems = BookingItem::bookingItemsWithRoomName($booking->id);
        $bookingContact = BookingContact::where('booking_id', $booking->id)->first();

        Mail::to($this->recipient->email)
            ->send(
                new Invoice($booking, $bookingItems, $bookingContact, $this->recipient));
    }

    public function sendPaymentConfirmation(){
        // generate and send payment confirmation to hotel (specified hotel email)
    }

    
}