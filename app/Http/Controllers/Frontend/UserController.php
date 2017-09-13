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
use Illuminate\Support\Facades\Session;

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
        $user = Auth::user();

        $user->first_name = $request['first_name'];
        $user->last_name = $request['last_name'];
        $user->phone = $request['phone'];

        $user->save();

        Session::flash('message', 'Success Updating Account!!!');

        return redirect('user');
    }

    public function addressCreate()
    {
        $provinces = Province::all();
        $cities = City::all();

        return view('', compact('provinces', 'cities'));
    }
}
