<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/dashboard';


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /*public function authenticate(Request $request)
    {
        if ( Auth::attempt(['email' => $request->email, 'password' => $request->password]) )
        {
            return redirect()->intended('/dashboard');
        }
    }*/


}
