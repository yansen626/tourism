<?php

namespace App\Http\Controllers\Frontend;

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
        $address = null;

        return view('frontend.user', compact('address'));
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
}
