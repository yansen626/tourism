<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserAddressController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        $provinces = Province::all();
        $cities = City::all();

        $id = Auth::user()->id;
        $data = Address::where('user_id', $id)->first();

        return view('frontend.user-address-edit', compact('data', 'provinces', 'cities'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'postal_code' => 'required',
            'detail' => 'required'
        ]);

        $temp = str_replace("'", "\"", $request['city_id']);
        $city_id = json_decode($temp, true);
        $user = Auth::user();

        if($city_id['city_id'] == 0){
            return redirect('/user/address/create')->withErrors('You Must Select a City!');
        }

        $provinceName = Province::find($request['province_id']);
        $cityName = City::find((int)$city_id['city_id']);

        $data = Address::where('user_id', $user->id)->first();
        $data->city_id = (int)$city_id['city_id'];
        $data->city_name = $cityName->name;
        $data->province_id = $request['province_id'];
        $data->province_name = $provinceName->name;
        $data->name = $request['name'];
        $data->postal_code = $request['postal_code'];
        $data->detail = $request['detail'];
        $data->user_id = $user->id;
        $data->status_id = 1;

        $data->save();

        Session::flash('message', 'Success Updating Address!!!');

        return redirect('user');
    }

    public function create()
    {
        $provinces = Province::all();
        $cities = City::all();

        return view('frontend.user-address-create', compact('provinces', 'cities'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'province_id' => 'required',
            'city_id' => 'required',
            'postal_code' => 'required',
            'detail' => 'required'
        ]);

        $temp = str_replace("'", "\"", $request['city_id']);
        $city_id = json_decode($temp, true);
        $user = Auth::user();

        if($city_id['city_id'] == 0){
            return redirect('/user/address/create')->withErrors('You Must Select a City!');
        }

        $provinceName = Province::find($request['province_id']);
        $cityName = City::find((int)$city_id['city_id']);

        $data = new Address();
        $data->city_id = (int)$city_id['city_id'];
        $data->city_name = $cityName->name;
        $data->province_id = $request['province_id'];
        $data->province_name = $provinceName->name;
        $data->name = $request['name'];
        $data->postal_code = $request['postal_code'];
        $data->detail = $request['detail'];
        $data->user_id = $user->id;
        $data->status_id = 1;

        $data->save();

        Session::flash('message', 'Success Creating Address!!!');

        return redirect('/user');
    }
}
