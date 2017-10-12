<?php

namespace App\Http\Controllers\Admin\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class RoomController extends Controller
{
	public function __construct() {
		$this->classname = new ClassName();
	}

	public function index(Request $request){
		$status = ($request->status)?$request->status:'all';
		$result = $this->ClassName->getSomethingByStatus($status);

		return $result;
	}
}