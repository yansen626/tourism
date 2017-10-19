<?php

namespace App\Http\Controllers\Frontend;

use App\libs\RajaOngkir;
use App\libs\Utilities;
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

        $id = Auth::user()->id;
        $addr = Address::where('user_id', $id)->first();


        $cities = City::where('province_id', $addr->province_id)->get();
        $collect = RajaOngkir::getSubdistrict($addr->city_id);
        $subdistricts = $collect->rajaongkir->results;

        $redirect = 'default';
        if(!empty(request()->redirect)){
            $redirect = 'checkout';
        }

        $data = [
            'provinces'         => $provinces,
            'cities'            => $cities,
            'addr'              => $addr,
            'subdistricts'      => $subdistricts,
            'redirect'          => $redirect
        ];

        return view('frontend.user-address-edit')->with($data);
    }

    public function update(Request $request)
    {
        try{
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

            if(!empty(Input::get('redirect')) && Input::get('redirect') == 'checkout'){
                return redirect()->route('checkout');
            }

            return redirect('user');
        }
        catch(\Exception $ex){
            Utilities::ExceptionLog($ex);
        }
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
