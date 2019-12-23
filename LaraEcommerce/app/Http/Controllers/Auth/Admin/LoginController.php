<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Notifications\VerifyRegistration;
use App\Models\Admin;
use Auth;
use Illuminate\Http\Request;

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

    use AuthenticatesUsers;

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
        $this->middleware('guest')->except('logout');
    }

    // override this method
   // comes from this directory use Illuminate\Foundation\Auth\AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.admin.login');
    }

   // override this method
   // comes from this directory use Illuminate\Foundation\Auth\AuthenticatesUsers;
   
   public function login(Request $request)
   {
       $request->validate([
           'email' => 'required|string',
           'password'=> 'required',
       ]);

  
        // login this user
        if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
        // log in now
        return redirect()->intended(route('admin.index'));    
        } else{
        session()->flash('sticky_error','Invalid login');
        return redirect()->route('auth.admin.login');
        }
          

   }

   // override this method
   // comes from this directory use Illuminate\Foundation\Auth\AuthenticatesUsers;

   public function logout(Request $request)
   {
       $this->guard()->logout();

       $request->session()->invalidate();

       return $this->loggedOut($request) ?: redirect()->route('auth.admin.login');
   }
   

}
