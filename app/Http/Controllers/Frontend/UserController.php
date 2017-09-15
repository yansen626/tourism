<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $address = Address::where('user_id', Auth::id())->first();

        return view('frontend.show-user-profile', compact('address'));
    }

    public function edit()
    {
        $id = Auth::user()->id;

        $data = User::find($id);

        return view('frontend.user-edit-show', compact('data'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'first_name'            => 'required|max:100',
                'last_name'             => 'required|max:100',
                'phone'                 => 'required|max:20'
            ]
        );

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        $user = Auth::user();

        $user->first_name = Input::get('first_name');
        $user->last_name = Input::get('last_name');
        $user->phone = Input::get('phone');

        $user->save();

        Session::flash('message', 'Profile Updated!');

        return Redirect::route('user-profile');
    }

    public function passwordChange(){
        return View('frontend.edit-password');
    }

    public function passwordUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current-password'      => 'required',
            'password'              => 'required|min:6|max:20|same:password',
            'password-confirmation' => 'required|same:password'
        ]);

        if($validator->fails()){
            $this->throwValidationException(
                $request, $validator
            );
        }

        $curentPassword = Auth::user()->password;
        if(Hash::check(Input::get('current-password'), $curentPassword))
        {
            $user_id = Auth::user()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make(Input::get('password'));
            $obj_user->save();

            Session::flash('message', 'Password Updated!');

            return Redirect::route('user-profile');
        }
        else{
            return redirect()->back()->withErrors('Wrong Password!', 'default');
        }
    }
}
