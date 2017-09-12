<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 8/31/2017
 * Time: 11:29 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Models\Address;
use App\Http\Controllers\Controller;
use App\Models\Courier;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\DeliveryType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;

class TransactionController extends Controller
{
    //
    public function CheckoutProcess1(){

        $id = Auth::user()->id;
        $data = Address::where('user_id', $id)->first();

        return view('frontend.checkout-step1', compact('data'));
    }


    //
    public function CheckoutProcess2(){
        $deliveryTypes = DeliveryType::all();

        //get price shipping using rajaongkir

        return view('frontend.checkout-step2', compact('deliveryTypes'));
    }
    public function CheckoutProcess2Submit(Request $request){
        $user = Auth::user();
        $userId = $user->id;

        $selectedShipping   = $request['shippingRadio'];
        $splitedShipping = explode('-', $selectedShipping);

        $carts = Cart::where('user_id', 'like', $userId)->get();
        foreach ($carts as $cart){
            $cart->courier_id = $splitedShipping[0];
            $cart->delivery_type_id = $splitedShipping[1];
            $cart->delivery_fee = $splitedShipping[2];

            $cart->save();
        }
        return redirect()->route('checkout3');
    }
    //
    public function CheckoutProcess3(){

        $couriers = Courier::all();
        $deliveryTypes = DeliveryType::all();

        $courierThrow = "";
        $temp = 1;
        //get courier code ex jne:tiki:pos
        foreach($couriers as $courier){
            if($temp < $couriers->count()){
                $courierThrow = $courierThrow.$courier->code.":";
            }
            else{
                $courierThrow = $courierThrow.$courier->code;
            }
            $temp++;
        }

        //rajaongkir process
        $client = new Client([
            'base_uri' => env('API_HOST'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'key' => 'b3d50254282ab0e5907bedacf1eb1e3f'
            ],
        ]);
        $request = $client->request('POST', 'https://pro.rajaongkir.com/api/cost', [
            'form_params' => [
                'origin' => '151',
                'originType' => 'city',
                'destination' => '456',
                'destinationType' => 'city',
                'weight' => '1700',
                'courier' => $courierThrow,
            ]
        ]);
        if($request->getStatusCode() == 200){
            $responseData = json_decode($request->getBody());
            $results = $responseData->rajaongkir->results;

            $arr = array();
            $i = 0;
            foreach ($deliveryTypes as $deliveryType){
                $arr[$i] = $deliveryType->Courier->description." - ".$deliveryType->description;
                $i++;
            }

            foreach($results as $result){
                foreach ($result->costs as $cost){

                }
            }
        }

        //return view('frontend.checkout-step3');
    }
    //
    public function CheckoutProcess4(){
        return view('frontend.checkout-step4');
    }
}