<?php 

namespace App\Http\Controllers\User\Auth;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

// Only authenticated admin can access this class
class ChangePasswordController extends Controller
{
	public function __construct(){
		$this->middleware('guest:web_admin');
	}

	public function showChangePasswordForm(){
		return view( 'auth.user.passwords.change' );
	}

	public function handleChangePassword(Request $request ){

		$this->validate($request,[
			'old_password' => 'bail|required|min:6',
            'password' => 'bail|required|min:6|confirmed'
        ], [
            'old_password.required' =>  'old password is required',
            'old_password.min' => 'old password must be greater than 5 characters',
            'password.required' => 'new password is required',
            'password.min' => 'new password must be greater than 5 characters',
            'password.confirmed' => 'password confirmation does not match new password'
        ]);

        if(!Hash::check($request->input('old_password'), Auth::User()->password)){
        	$request->session()->flash('old-password-error', 'Old password is incorrect');
        	return view('auth.user.passwords.change');
        }

		Auth::User()->update([
			'password' => bcrypt( $request->input('password')) 
		]);

		$request->session()->flash('change-password-success', 'password is updated successfully');

		return redirect(url()->previous());

	}

}