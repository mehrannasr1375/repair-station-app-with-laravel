<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// This controller handles authenticating users for the application and redirecting them to your home screen. The controller uses a trait to conveniently provide its functionality to your applications.

class LoginController extends Controller
{


    
    use AuthenticatesUsers;


    
    protected $redirectTo = '/dashboard';



    // Create a new controller instance
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    
    /* replace login with 'email' with 'name'  
    public function username()
    {
        return 'username';
    }
*/


/*
    public function authenticate(Request $request)
    {
        if ( Auth::attempt(['email' => $request->email, 'password' => $request->password]) )
        {
            return redirect()->intended('/dashboard');
        }
    }
*/

}
