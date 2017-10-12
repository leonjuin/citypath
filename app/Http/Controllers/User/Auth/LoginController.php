<?php

namespace App\Http\Controllers\User\Auth;

use Crypt;
use Facebook;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Socialite;

class LoginController extends Controller
{
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
    public function __construct()
    {
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

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect('/login');
    }
    
    public function username()
    {
      return 'username';
    }

    public function showLoginForm()
    {
      return view('pages.user.login');
    }     

    public function redirectToProvider(Request $request, $provider)
    {
      switch ($request->callback) {
        case 'login': $callback = route('user-auth-provider-login', $provider);  break;
        case 'bind': $callback = route('user-auth-provider-bind', $provider);  break;
        
        default: throw new Exception('invalid-switch-type'); break;
      }
      

      return Socialite::driver($provider)->redirectUrl($callback)->redirect();
    }

    public function redirectToProviderForBind(Request $request, $provider)
    {
      $callback = route('user-auth-provider-bind', $provider); 

      return Socialite::driver($provider)->redirectUrl($callback)->redirect();
    }    

    public function providerLogin(Request $request, $provider)
    {
      $callback = route('user-auth-provider-login', $provider);
      $providerUser = Socialite::driver($provider)->redirectUrl($callback)->user();
      
      $ext = UserExternalId::where($provider , $providerUser->id )->first();

      if(!$ext){   
        $username = implode('', [$provider, '_', $providerUser->id]);

        $user = User::create([
          'name' => $providerUser->name,
          'username' => $username,
          'password' => NULL
        ]);
        $user->createBase([$provider => $providerUser->id]);

        $ext = UserExternalId::where('user_id' , $user->id)->first();
      }

      switch ($provider) {
        case 'facebook': $ext->updateFacebook($providerUser); break;
        case 'google': $ext->updateGoogle($providerUser); break;

        default: throw new Exception("invalid-switch-type"); break;
      }

      Auth::guard('web')->login($ext->user, true);

      return redirect('/');
    }   

    public function providerBind(Request $request, $provider)
    {
      $user = Auth::user();
      if(!$user){ return; }

      $callback = route('user-auth-provider-bind', $provider);
      $providerUser = Socialite::driver($provider)->redirectUrl($callback)->user();

      $user->externalId->update([
        $provider => $providerUser->id 
      ]);

      return redirect('/profile');
      
    }


}
