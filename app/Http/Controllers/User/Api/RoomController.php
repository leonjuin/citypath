<?php

namespace App\Http\Controllers\User\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Classes\RoomRateManager;
use App\Classes\RoomManager;
use App\Models\Room;
use App\Models\RoomRate;

class RoomController extends Controller
{
	public function roomsAvailability(Request $request){
		$default = [
			'from' => new Carbon('tomorrow'),
			'to' => (new Carbon('tomorrow'))->addDay(),
		];

		$manager = new RoomManager;

		$from = $request->input('from', $default['from']);
		$to = $request->input('to', $default['to']);

		$roomsAvailability = $manager->getAllRoomsAvailability($from, $to);

		return [
			'rooms_availability' => $roomsAvailability
		];
	}

	public function generateNinetyDaysDailyReport(Request $request){
		$manager = new RoomManager;

		$manager->createNinetyDaysRecord();
	}
}