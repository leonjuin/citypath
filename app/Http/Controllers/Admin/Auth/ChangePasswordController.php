<?php 

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin;
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

	public function showChangePasswordForm()
	{
		return view( 'auth.admin.passwords.change' );
	}

	public function handleChangePassword( Request $request )
	{
		$this->validate($request,[
			'password' => 'required|confirmed|min:6'
		]);

		$admin = Admin::where( 'email' , Auth::User()->email )->get()->first();

		if(Auth::user()->password == '') 
		{
			$this->storeWithoutPreviousPassword($admin, $request->input('password'));
			$request->session()->flash('password_success', 'Password has been added');

			return redirect('/admin');
		}

		if($this->storeWithPreviousPassword($request, $admin, $request->input('password'), $request->input('old_password'))){
			return redirect('/admin');
		}
		
		return redirect('/admin/password/change');

	}

	public function storeWithoutPreviousPassword(Admin $admin, $password)
	{
		$admin->update(['password' => bcrypt($request->input('password'))]);

	}

	public function storeWithPreviousPassword(Request $request, Admin $admin, $password, $oldPassword)
	{	
		if(Hash::check($oldPassword, Auth::User()->password))
		{
			$admin->update(['password' => bcrypt($password)]);
			$request->session()->flash( 'password_success', 'Password has been updated' );

			return true;
		} 

		$request->session()->flash('password_error', 'old password is incorrect');
		
		return false;

	}

}