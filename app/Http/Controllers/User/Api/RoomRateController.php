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

class RoomRateController extends Controller
{
	public function check(Request $request){
		$default = [
			'from' => new Carbon('tomorrow'),
			'to' => (new Carbon('tomorrow'))->addDay(),
		];

		$manager = new RoomRateManager;

		$from = $request->input('from', $default['from']);
		$to = $request->input('to', $default['to']);

		$rows = $manager->check($from, $to);

		$rate = [];
		foreach ($rows as $row) {
			$date = $row->sdate;
			unset($row->sdate);
			if(!array_key_exists($date, $rate)){
				$rate[$date] = [];
			}

			array_push($rate[$date], $row);
		}

		return [
			'rate' => $rate
		];
	}
}