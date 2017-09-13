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
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Client;
use function MongoDB\BSON\toJSON;

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
            'base_uri' => 'https://pro.rajaongkir.com/api/cost',
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

            $resultCollection = collect();
            foreach ($deliveryTypes as $deliveryType){
                $resultCollection->put($deliveryType->Courier->code."-".$deliveryType->code, $deliveryType->Courier->code."-".$deliveryType->code);
            }

            foreach($results as $result){
                foreach ($result->costs as $cost){
                    if($resultCollection->contains($result->code."-".$cost->service)){
                        $resultCollection[$result->code."-".$cost->service] = $cost->cost[0]->value;
                    }

                }
            }
        }
        return view('frontend.checkout-step2', compact('resultCollection', 'deliveryTypes'));
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
        $serverKey = "VT-server-2NH8CTXcytpqG1GcwFEtvq0s";
//        $base64ServerKey = base64_encode($serverKey);
//        $client = new Client([
//            'base_uri' => env('API_HOST'),
//            'headers' => [
//                'Accept' => 'application/json',
//                'Content-Type' => 'application/json',
//                'Authorization' => 'Basic '.$base64ServerKey
//            ],
//        ]);
//        $request = $client->request('POST', 'https://app.sandbox.midtrans.com/snap/v1/transactions', [
//            'form_params' => [
//                'origin' => '151',
//                'originType' => 'city'
//            ]
//        ]);

        $user = Auth::user();
        $userId = $user->id;

        $carts = Cart::where('user_id', 'like', $userId)->get();

        $transactionDetailsArr = [];
        $transactionDetailsArr = array_add($transactionDetailsArr, 'order_id', uniqid());
        $transactionDetailsArr = array_add($transactionDetailsArr, 'gross_amount', $carts->sum('total_price'));
//        $transaction_details = array(
//            'order_id'          => uniqid(),
//            'gross_amount'  => 200000
//        );

        $itemArr = [];
        foreach($carts as $cart){
            $price = $cart->getOriginal('total_price');
            $arr = [];
            $arr = array_add($arr, 'id', $cart->id);
            $arr = array_add($arr, 'price', $price);
            $arr = array_add($arr, 'quantity', $cart->quantity);
            $arr = array_add($arr, 'name', $cart->Product->name);

            array_push($itemArr, $arr);
        }

//        $items = [
//            array(
//                'id'                => 'item1',
//                'price'         => 100000,
//                'quantity'  => 1,
//                'name'          => 'Adidas f50'
//            ),
//            array(
//                'id'                => 'item2',
//                'price'         => 50000,
//                'quantity'  => 2,
//                'name'          => 'Nike N90'
//            )
//        ];
            $transactionDataArr = [];
        $transactionDataArr = array_add($transactionDataArr, 'payment_type', 'vtweb');
        $transactionDataArr = array_add($transactionDataArr, 'transaction_details', $transactionDetailsArr);
        $transactionDataArr = array_add($transactionDataArr, 'item_details', $itemArr);

//        $transaction_data = array(
//            'payment_type'          => 'vtweb',
//            'vtweb'                         => array(
//                //'enabled_payments'    => [],
//                'credit_card_3d_secure' => true
//            ),
//            'transaction_details'=> $transaction_details,
//            'item_details'           => $items,
//            'customer_details'   => $customer_details
//        );
        json_encode($transactionDataArr);
        //return view('frontend.checkout-step3');
    }
    public function CheckoutProcess3Submit(Request $request){

        return redirect()->route('checkout4');
    }
    //
    public function CheckoutProcess4(){
        return view('frontend.checkout-step4');
    }
}