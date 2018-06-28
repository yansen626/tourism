<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
    //protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email'                 => 'required|email|max:100',
                'password'              => 'required|max:20'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'status_id' => 1])) {
            return redirect()->action('Frontend\HomeController@home');
        }
        else if(Auth::guard('travelmates')->attempt(['email' => $request['email'], 'password' => $request['password']])){
//            return redirect()->action('Travelmate\HomeController@dashboard');
            return redirect()->action('Frontend\HomeController@home');
        }
        else
        {
            return redirect()->route('login')->withErrors('Wrong email or password');
        }
    }

    public function email(){

    }

    public function login(){
        $redirect = "";
        if(!empty(request()->redirect)){
            $redirect = request()->redirect;
        }
        return view('auth/login', compact('redirect'));
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        /*
         * Remove the socialite session variable if exists
         */

        \Session::forget(config('access.socialite_session_name'));

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect()->action('Frontend\HomeController@home');
    }
}
