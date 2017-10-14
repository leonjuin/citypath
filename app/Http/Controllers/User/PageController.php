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
}
