<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Notifications\VerifyRegistration;
use App\Models\User;
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
    protected $redirectTo = '/';

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
   
   public function login(Request $request)
   {
       $request->validate([
           'email' => 'required|string',
           'password'=> 'required',
       ]);

       // Find user by this email
       $user = User::where('email',$request->email)->first();
       if($user->status==1){
           // login this user
           if(Auth::guard('web')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
           // log in now
           return redirect()->intended(route('index'));    
           } else{
            session()->flash('sticky_error','Invalid login');
            return redirect()->route('login');
           }
          }else{
               // send a token again for user
               if(!is_null($user)){
                   $user->notify(new VerifyRegistration($user));
                   session()->flash('success','A new confirmation email has sent to you...Please check and confirm your email');
                   return redirect('/');  
               }else{
                session()->flash('sticky_error','Please login first');
                return redirect()->route('login');
               }
           }
       

   }
   

}
