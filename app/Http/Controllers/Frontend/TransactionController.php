<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 8/31/2017
 * Time: 11:29 AM
 */

namespace App\Http\Controllers\Frontend;

use App\libs\Midtrans;
use App\libs\RajaOngkir;
use App\libs\Utilities;
use App\Http\Controllers\Controller;
use App\Mail\EmailTransactionNotif;
use App\Mail\EmailTransactionNotifUser;
use App\Models\Address;
use App\Models\Courier;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Models\Cart;
use App\Models\DeliveryType;
use App\Notifications\TransactionNotify;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Webpatser\Uuid\Uuid;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //set address for shipping
    public function CheckoutProcess1(){
//        if (!Auth::check())
//        {
//            return redirect()->route('landing');
//        }
        $id = Auth::user()->id;
        if(!Cart::where('user_id', $id)->exists()){
            return Redirect::route('cart-list');
        }

        $Addressdata = Address::where('user_id', $id)->first();

        return View('frontend.checkout-step1', compact('Addressdata'));
    }


    //show shipping list
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
        //address login user
        $id = Auth::user()->id;
        $Addressdata = Address::where('user_id', $id)->first();

        //get product total weight
        $totalWeight = 0;
        $carts = Cart::where('user_id', 'like', $id)->get();
        foreach($carts as $cart){
            $totalWeight += ($cart->product->weight * $cart->quantity);
        }

        //rajaongkir process
        $collect = RajaOngkir::getCost('151', 'city', $Addressdata->city_id, 'city', (string)$totalWeight, $courierThrow);
        $results = $collect->rajaongkir->results;

        $resultCollection = collect();
        foreach ($deliveryTypes as $deliveryType){
            $resultCollection->put($deliveryType->courier->code."-".$deliveryType->code, $deliveryType->courier->code."-".$deliveryType->code);
        }

        foreach($results as $result){
            foreach ($result->costs as $cost){
                if($resultCollection->contains($result->code."-".$cost->service)){
                    $resultCollection[$result->code."-".$cost->service] = $cost->cost[0]->value;
                }

            }
        }
        return view('frontend.checkout-step2', compact('resultCollection', 'deliveryTypes'));
    }

    //submit shipping and add data to DB
    public function CheckoutProcess2Submit(Request $request){
        if (!Auth::check())
        {
            return redirect()->route('landing');
        }

        if(empty(Input::get('shippingRadio'))){
            return redirect()->route('checkout2');
        }

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

    //checkout item, address, shipping and courier, price
    public function CheckoutProcess3(){
        if (!Auth::check())
        {
            return redirect()->route('landing');
        }
        $user = Auth::user();
        $userId = $user->id;

        //get all item from DB
        $carts = Cart::where('user_id', 'like', $userId)->get();
        $userData = User::where('id', 'like', $userId)->first();
        $userAddress = Address::where('user_id', 'like', $userId)->first();

        $totalPrice = 0;
        $shipping = 0;
        $grandTotal = 0;
        foreach($carts as $cart){
            $totalPriceTem = $cart->getOriginal('total_price');
            $totalPrice +=  $totalPriceTem;
            $shipping = $cart->getOriginal('delivery_fee');

        }
        $grandTotal = $totalPrice + $shipping;

        $totalPrice = number_format($totalPrice, 0, ",", ".");
        $shipping = number_format($shipping, 0, ",", ".");
        $grandTotal = number_format($grandTotal, 0, ",", ".");

        return view('frontend.checkout-step3', compact('carts', 'userData', 'userAddress', 'totalPrice', 'shipping', 'grandTotal'));
    }

    //select payment method
    public function CheckoutProcess4(){
        if (!Auth::check())
        {
            return redirect()->route('landing');
        }
        $user = Auth::user();
        $userId = $user->id;
        $carts = Cart::where('user_id', 'like', $userId)->get();

        $totalPrice = 0;
        $shipping = 0;
        $grandTotal = 0;
        foreach($carts as $cart){
            $totalPriceTem = $cart->getOriginal('total_price');
            $totalPrice +=  $totalPriceTem;
            $shipping = $cart->getOriginal('delivery_fee');

        }
        $grandTotal = $totalPrice + $shipping;

        $totalPrice = number_format($totalPrice, 0, ",", ".");
        $shipping = number_format($shipping, 0, ",", ".");
        $grandTotal = number_format($grandTotal, 0, ",", ".");
        return view('frontend.checkout-step4', compact('totalPrice', 'shipping', 'grandTotal'));
    }

//    //bank transfer
//    public function CheckoutProcessBank(){
//        return view('frontend.checkout-step4-bank');
//    }
//
//    //bank transfer process
//    public function CheckoutProcessBankSubmit(Request $request){
//        $user = Auth::user();
//        $userId = $user->id;
//
//        $validator = Validator::make($request->all(),[
//            'sender_name'                   => 'required',
//            'transfer_date'                  => 'required',
//            'receiver_bank'                 => 'required',
//            'transfer_amount'                => 'required'
//        ]);
//
//        if ($validator->fails()) {
//            $this->throwValidationException(
//                $request, $validator
//            );
//        }
//        else {
//
//        }
//
//        //return ke page transaction
//        return redirect()->route('checkout4');
//    }

    //midtrans process
    public function CheckoutProcessMidtrans(Request $request){

        if (!Auth::check())
        {
            return redirect()->route('landing');
        }
        $user = Auth::user();
        $userId = $user->id;

        if(empty(Input::get('payment'))){
            return redirect()->route('checkout4');
        }

        $enabledPayments = Input::get('payment');

        $adminFee   = (int)$request['selected-fee'];

        //set data to request
        $transactionDataArr = Midtrans::setRequestData($userId, $adminFee, $enabledPayments);

        //sending to midtrans
        $redirectUrl = Midtrans::sendRequest($transactionDataArr);

        return redirect($redirectUrl);
    }

    //payment online failed
    public function CheckoutProcessFailed(){

        $transactionDB = Transaction::where('order_id', '=', '59ba09dc171c4')->first();
//        $userMail = $transactionDB->user;
//
//        $userMail->notify(new TransactionNotify($transactionDB));

        $userMail = "yansen626@gmail.com";
        $emailBody = new EmailTransactionNotifUser($transactionDB);
        Mail::to($userMail)->send($emailBody);

        return view('frontend.checkout-step4-failed');
    }
}