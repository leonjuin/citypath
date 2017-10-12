<?php

namespace App\Http\Controllers\User;

use App\Exceptions\Handler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Classes\MailManager;
use App\Classes\PaymentManager;
use App\Models\Room;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\User;
use App\Models\PaymentEghl;
use App\Models\Order;
use App\Models\Payment;
use DB;

class PageController extends Controller
{
   public function index(){
      return view('pages.user.home');
   }
   public function about(){
      return view('pages.user.about');
   }
   public function room(){
      return view('pages.user.room');
   }
   public function deluxeTriple(){
      return view('pages.user.deluxe-triple');
   }
   public function superiorQueen(){
      return view('pages.user.superior-queen');
   }
   public function superiorKing(){
      return view('pages.user.superior-king');
   }
   public function suiteRoom(){
      return view('pages.user.suite-room');
   }
   public function chooseRoom(){
      $rooms = Room::all();

      return view('pages.user.choose-room',[
         'rooms' => $rooms
      ]);
      // return view('pages.user.choose-room');
   }
   public function bookYourStay(){
      return view('pages.user.book-your-stay');
   }
   public function paymentSuccess(Request $request){
      if($request->isMethod('post')){
         $booking = [];

         $paymentManager = new PaymentManager;
         $payment = Payment::where('order_id', $request->input('OrderNumber'))->first(); 
         $booking = $paymentManager->paymentSuccess($request, $booking);
         $formattedBookingItems = BookingItem::bookingItemsWithRoomName($booking->id);

         $user = User::where('id' , $booking->user_id)->first();
         $email = $user->email;

         $mailManager = new MailManager($user);
         $mailManager->sendBookingInvoice($booking);

         return view('pages.user.confirmation', [
            'payment' => $payment,
            'email' => $email,
            'booking' => $booking,
            'bookingItems' => $formattedBookingItems
         ]);
      }
      
      return redirect('/reservation');

   }

   public function paymentFailed(){
      return view('pages.user.failed');
   }

   public function gallery(){
      return view('pages.user.gallery');
   }

   public function contact(){
      return view('pages.user.contact');
   }
   
   public function privacypolicy(){
      return view('pages.user.privacy-policy');
   }

   public function terms(){
      return view('pages.user.terms');
   }
}
