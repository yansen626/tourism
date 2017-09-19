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
                'password'              => 'required|min:6|max:20'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'status_id' => 1])) {
            // Authentication passed...
            error_log(Input::get('redirect'));
            if(!empty(Input::get('redirect'))){
                return redirect(Input::get('redirect'));
            }
            else{
                return redirect()->action('Frontend\HomeController@home');
            }
        }
        else
        {
            $user = User::where('email',Input::get('email'))->first();
            if($user != null && Hash::check(Input::get('password'), $user->getAuthPassword())){
                $emailVerify = new EmailVerification($user);
                Mail::to($user->email)->send($emailVerify);

                return View('auth.send-email')->with('email',Input::get('email'));
            }
            else{
                return redirect()->route('login')->withErrors('Wrong email or password');
            }
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
}
