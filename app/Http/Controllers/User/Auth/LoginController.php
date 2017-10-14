<?php

namespace App\Http\Controllers\User\Auth;

use Crypt;
use Facebook;
use Carbon\Carbon;
use App\Models\User;
use App\Classes\Social\FacebookEngine;
use App\Classes\Social\GoogleEngine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers{
    logout as performLogout;
    login as performLogin;
  }

  /**
   * Where to redirect users after login.
   *
   * @var string
   */
  protected $redirectTo = '/';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(){
    $this->middleware('guest', ['except' => ['logout', 'redirectToProvider', 'providerBind']]);
  }

  public function Login(Request $request){
    $this->validate($request,[
      'username' => 'required|min:3',
      'password' => 'required|min:6'
    ],[
      'username.required' => 'Username is required',
      'username.min' => 'Username must contain at least 3 characters',
      'password.required' => 'Password is required',
      'password.min' => 'Password must contain at least 6 characters'
    ]);

   if(!Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])){
      session()->flash('login_error', 'credential invalid');
      return redirect('/login');
   }
   return redirect('/');

  }

  public function logout(Request $request){
    $this->performLogout($request);
    return redirect('/login');
  }
  
  public function username(){
    return 'username';
  }

  public function showLoginForm(){
    return view('pages.user.login');
  }    

  public function loginWithFacebook(){
    $facebook = new FacebookEngine;
    $facebook->login();
  } 

  public function loginWithGoogle(){
    $google = new GoogleEngine;
    $google->login();
  }
}
