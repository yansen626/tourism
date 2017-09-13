<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Address;
use App\Models\City;
use App\Models\Province;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'province_id' => 'required|option_not_default',
            'city_id' => 'required|option_not_default',
            'subdistrict_id' => 'required|option_not_default',
            'postal_code' => 'required',
            'detail' => 'required'
        ],[
            'option_not_default'    => 'Invalid input'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $temp = str_replace("'", "\"", $request['city_id']);
        $city_id = json_decode($temp, true);
        $user = Auth::user();

        if($city_id['city_id'] == 0){
            return redirect('/user/address/create')->withErrors('You Must Select a City!');
        }

        $provinceName = Province::find($request['province_id']);
        $cityName = City::find((int)$city_id['city_id']);

        $subdistrict = explode(',', Input::get('subdistrict'));

        $data = Address::where('user_id', $user->id)->first();
        $data->city_id = (int)$city_id['city_id'];
        $data->city_name = $cityName->name;
        $data->province_id = $request['province_id'];
        $data->province_name = $provinceName->name;
        $data->subdistrict_id = $subdistrict[0];
        $data->subdistrict_name = $subdistrict[1];
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
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'province_id' => 'required|option_not_default',
            'city_id' => 'required|option_not_default',
            'subdistrict_id' => 'required|option_not_default',
            'postal_code' => 'required',
            'detail' => 'required'
        ],[
            'option_not_default'    => 'Invalid input'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        $temp = str_replace("'", "\"", $request['city_id']);
        $city_id = json_decode($temp, true);
        $user = Auth::user();

        if($city_id['city_id'] == 0){
            return redirect('/user/address/create')->withErrors('You Must Select a City!');
        }

        $provinceName = Province::find($request['province_id']);
        $cityName = City::find((int)$city_id['city_id']);

        $subdistrict = explode(',', Input::get('subdistrict_id'));

        $data = new Address();
        $data->city_id = (int)$city_id['city_id'];
        $data->city_name = $cityName->name;
        $data->province_id = $request['province_id'];
        $data->province_name = $provinceName->name;
        $data->subdistrict_id = $subdistrict[0];
        $data->subdistrict_name = $subdistrict[1];
        $data->name = $request['name'];
        $data->postal_code = $request['postal_code'];
        $data->detail = $request['detail'];
        $data->user_id = $user->id;
        $data->status_id = 1;

        $data->save();

        Session::flash('message', 'Success Creating Address!!!');

        return redirect('/user');
    }

    public function getSubdistrict($cityId){
        $client = new Client([
            'base_uri' => 'https://pro.rajaongkir.com/api/subdistrict?city='. $cityId,
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY')
            ],
        ]);

        $request = $client->request('GET', 'https://pro.rajaongkir.com/api/subdistrict?city='. $cityId);

        if($request->getStatusCode() == 200){
            $collect = json_decode($request->getBody());

            $returnHtml = View('frontend.partials._subdistrict-option',['collect' => $collect])->render();

            return response()->json( array('success' => true, 'html' => $returnHtml) );
        }
    }
}
