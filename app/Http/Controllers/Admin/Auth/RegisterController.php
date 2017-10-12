<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use App\Models\AdminExternalId;
use App\Models\AdminExternalRequest;
use App\Models\LogLoginAttemptAdmin;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Foundation\Auth\RegistersUsers;

use Socialite;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/admin/';

    public function __construct()
    {
        $this->middleware('guest:web_admin', ['except' => ['bindSocialAccount']]);
    }

    protected function guard()
    {
        return Auth::guard('web_admin');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:50',
            'username' => 'required|min:4|max:20',
            'type' => 'required',
            'password' => 'required|min:6|confirmed',
            'pin' => 'regex:[^'. config('auth.pin') .'$]'
        ]);
    }

    protected function create(array $data)
    {
        $user = Admin::create([
                    'name' => $data['name'],
                    'username' => $data['username'], 
                    'type' => $data['type'],
                    'password' => bcrypt($data['password'])]);
        $user->createBase();

        return $user;
    }    

    public function showRegistrationForm()
    {
        return view('auth.admin.register');
    } 

    public function showRequestForm()
    {
        return view('auth.admin.request');
    }   

    public function bindSocialAccount($provider)
    {
        $callback = route('auth-provider-bind-social-account', $provider);
        $userSocial = Socialite::driver($provider)->redirectUrl($callback)->user();

        $user = Auth::guard('web_admin')->user();
        $userExternalId = AdminExternalId::where('admin_id', $user->id)->first();

        switch($provider) {
            case 'facebook' : 
                $userExternalId->facebook = $userSocial->id; break;

            case 'google' :
                $userExternalId->google = $userSocial->id; break;
        }
        $userExternalId->save();

        return redirect('/admin');
    }


}
