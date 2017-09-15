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
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\TransferConfirmation;
use App\Models\User;
use App\Models\Cart;
use App\Models\DeliveryType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Webpatser\Uuid\Uuid;
use App\libs\Utilities;
use App\Mail\EmailTransactionNotif;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    //set address for shipping
    public function CheckoutProcess1(){
        if (!Auth::check())
        {
            return redirect()->route('landing');
        }
        $id = Auth::user()->id;
        $Addressdata = Address::where('user_id', $id)->first();

        return view('frontend.checkout-step1', compact('Addressdata'));
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
                $resultCollection->put($deliveryType->courier->code."-".$deliveryType->code, $deliveryType->courier->code."-".$deliveryType->code);
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

    //submit shipping and add data to DB
    public function CheckoutProcess2Submit(Request $request){
        if (!Auth::check())
        {
            return redirect()->route('landing');
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

        $enabledPayments = $request['shippingRadio'];
        $adminFee   = (int)$request['selected-fee'];

        //get all item from DB
        $carts = Cart::where('user_id', 'like', $userId)->get();
        $totalPrice = 0;

        //transaction_details 1
        $uniqId = uniqid();
        $transactionDetailsArr = [];
        $transactionDetailsArr = array_add($transactionDetailsArr, 'order_id', $uniqId);

        //item_details
        $itemArr = [];
        foreach($carts as $cart){
            $PriceDB = (int)$cart->getOriginal('total_price') / $cart->quantity;
            $totalPriceDB = (int)$cart->getOriginal('total_price');
            $totalPrice += $totalPriceDB;

            //set item detail
            $arrItem = [];
            $arrItem = array_add($arrItem, 'id', $cart->id);
            $arrItem = array_add($arrItem, 'price', $PriceDB);
            $arrItem = array_add($arrItem, 'quantity', $cart->quantity);
            $arrItem = array_add($arrItem, 'name', $cart->Product->name);
            array_push($itemArr, $arrItem);

            $selectedCourier = $cart->Courier->description;
            $selectedDeliveryType = $cart->DeliveryType->description;
            $ShippingPrice = (int)$cart->getOriginal('delivery_fee');

            //set order id and admin fee to cart DB
            $cart->order_id = $uniqId;
            $cart->admin_fee = $adminFee;
            $cart->payment_method = $enabledPayments == 'credit_card'?2:1;

            $cart->save();
        }
        $arrShipping = [];
        $arrShipping = array_add($arrShipping, 'id', uniqid());
        $arrShipping = array_add($arrShipping, 'price', $ShippingPrice);
        $arrShipping = array_add($arrShipping, 'quantity', 1);
        $arrShipping = array_add($arrShipping, 'name', 'Ongkos Kirim '.$selectedCourier.'-'.$selectedDeliveryType);

        array_push($itemArr, $arrShipping);

        $arrAdminFee = [];
        $arrAdminFee = array_add($arrAdminFee, 'id', uniqid());
        $arrAdminFee = array_add($arrAdminFee, 'price', $adminFee);
        $arrAdminFee = array_add($arrAdminFee, 'quantity', 1);
        $arrAdminFee = array_add($arrAdminFee, 'name', 'Biaya admin');

        array_push($itemArr, $arrAdminFee);

        $totalPrice += $ShippingPrice;
        $totalPrice += $adminFee;

        //transaction_details 2
        $transactionDetailsArr = array_add($transactionDetailsArr, 'gross_amount', $totalPrice);

        //vtweb
        $vtWebArr = [];
        $vtWebArr = array_add($vtWebArr, 'credit_card_3d_secure', true);
        // credit card = credit_card
        // bank transfer = bank_transfer
        // e-wallet =
        // direct debit = mandiri_clickpay, cimb_clicks, bri_epay, bca_klikpay

//      $vtWebArr = array_add($vtWebArr, 'enabled_payments', ['credit_card', 'mandiri_clickpay', 'cimb_clicks', 'bca_klikpay', 'bri_epay', 'echannel','permata_va','bca_va','other_va']);
        $vtWebArr = array_add($vtWebArr, 'enabled_payments', [$enabledPayments]);
        $vtWebArr = array_add($vtWebArr, 'finish_redirect_url', 'http://localhost:8000/checkout-success/'.$userId);
        $vtWebArr = array_add($vtWebArr, 'unfinish_redirect_url', 'http://localhost:8000/checkout-failed');
        $vtWebArr = array_add($vtWebArr, 'error_redirect_url', 'http://localhost:8000/checkout-failed');


        $transactionDataArr = [];
        $transactionDataArr = array_add($transactionDataArr, 'payment_type', 'vtweb');
        $transactionDataArr = array_add($transactionDataArr, 'transaction_details', $transactionDetailsArr);
        $transactionDataArr = array_add($transactionDataArr, 'item_details', $itemArr);
        $transactionDataArr = array_add($transactionDataArr, 'vtweb', $vtWebArr);

        //create json for sending to midtrans
        json_encode($transactionDataArr);

        //sending to midtrans
        $serverKey = "VT-server-2NH8CTXcytpqG1GcwFEtvq0s";
        $base64ServerKey = base64_encode($serverKey);
        $client = new Client([
            'base_uri' => 'https://api.sandbox.midtrans.com/v2/charge',
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.$base64ServerKey
            ],
        ]);
        $request = $client->request('POST', 'https://api.sandbox.midtrans.com/v2/charge', [
            'json' => $transactionDataArr
        ]);

        if($request->getStatusCode() == 200){
            $responseData = json_decode($request->getBody());
            $redirectUrl = $responseData->redirect_url;

            return redirect($redirectUrl);
        }
    }

    //payment online success
    public function CheckoutProcessSuccess($userId){
        //transactions data
        $dateTimeNow = Carbon::now('Asia/Jakarta');
        $carts = Cart::where('user_id', 'like', $userId)->get();
        $userData = User::where('id', 'like', $userId)->first();
        $userAddress = Address::where('user_id', 'like', $userId)->first();

        $totalPrice = 0;
        $totalPriceWithDeliveryFee = 0;

        foreach ($carts as $cart) {
            $PriceDB = (int)$cart->getOriginal('total_price') / $cart->quantity;
            $totalPriceDB = (int)$cart->getOriginal('total_price');
            $totalPrice += $totalPriceDB;
            $orderId = $cart->order_id;
            $ShippingPrice = (int)$cart->getOriginal('delivery_fee');
            $adminFee = (int)$cart->getOriginal('admin_fee');
            $paymentMethod = $cart->payment_method;
        }
        $totalPriceWithDeliveryFeeAdminFee = $totalPrice + $ShippingPrice + $adminFee;

        //insert into transactions DB
        $transaction = Transaction::create([
            'id'                => Uuid::generate(),
            'user_id'           => $userId,
            'order_id'          => $orderId,
            'total_payment'     => $totalPriceWithDeliveryFeeAdminFee,
            'total_price'       => $totalPrice,
            'address_name'      => $userAddress->name,
            'phone'             => $userData->phone,
            'province_id'       => $userAddress->province_id,
            'province_name'     => $userAddress->province_name,
            'city_id'           => $userAddress->city_id,
            'city_name'         => $userAddress->city_name,
            'subdistrict_id'    => $userAddress->subdistrict_id,
            'subdistrict_name'  => $userAddress->subdistrict_name,
            'postal_code'       => $userAddress->postal_code,
            'address_detail'    => $userAddress->detail,
            'courier'           => $carts[0]->courier->description,
            'courier_code'      => $carts[0]->courier->code,
            'delivery_type'     => $carts[0]->deliveryType->description,
            'delivery_type_code'=> $carts[0]->deliveryType->code,
            'delivery_fee'      => $ShippingPrice,
            'admin_fee'         => $adminFee,
            'status_id'         => 3,
            'created_on'        => $dateTimeNow->toDateTimeString(),
            'created_by'        => $userId
        ]);
        if($paymentMethod == "credit_card"){
            $transaction->payment_method_id = 2;
            $transaction->paid_date = $dateTimeNow->toDateTimeString();
            $transaction->status_id = 4;
        }
        else{
            $transaction->payment_method_id = 1;
        }
        $transaction->save();

        $transaction->invoice = Utilities::GenerateInvoice();
        $transaction->save();

        $savedId = $transaction->id;

        //set transaction detail
        foreach ($carts as $cart) {
            $id = Uuid::generate();
            $transactionDetail = TransactionDetail::create([
                'id'                => $id,
                'transaction_id'    => $savedId,
                'product_id'        => $cart->product_id,
                'name'              => $cart->product->name,
                'weight'            => $cart->product->weight,
                'price_basic'       => $cart->product->getOriginal('price'),
                'quantity'          => $cart->quantity,
                'subtotal_price'    => $cart->getOriginal('total_price'),
                'created_on'        => $dateTimeNow->toDateTimeString(),
                'created_by'        => $userId
            ]);

            if (!empty ($cart->Product->discount)) {
                $discountTemp = $cart->product->getOriginal('discount');
                $transactionDetail->discount = $discountTemp;
            }
            if (!empty ($cart->product->discount_flat)) {
                $discountFlatTemp = $cart->product->getOriginal('discount_flat');
                $transactionDetail->discount_flat = $discountFlatTemp;
            }
            if (!empty ($cart->product->price_discounted)){
                $priceDiscountTemp = $cart->product->getOriginal('price_discounted');
                $transactionDetail->price_final = $priceDiscountTemp;
            }
            else{
                $transactionDetail->price_final = $cart->product->getOriginal('price');
            }

            $transactionDetail->save();
        }

        //delete cart from database
        foreach($carts as $cart){
            $cart->delete();
        }

        return redirect()->route('user-payment-list');
    }

    //payment online failed
    public function CheckoutProcessFailed(){

        $emailBody = new EmailTransactionNotif();
        Mail::to('d1d124acf0-fa64ac@inbox.mailtrap.io')->send($emailBody);

        //return view('frontend.checkout-step4-failed');
    }

    public function CheckoutProcessNotification(Request $request){

//        $selectedShipping   = $request['status_code'];
//        $selectedShipping   = $request['status_message'];
//        $selectedShipping   = $request['order_id'];
//        $selectedShipping   = $request['transaction_status'];
//        $selectedShipping   = $request['payment_type'];
//        $selectedShipping   = $request['gross_amount'];
//
//        $selectedShipping   = $request['transaction_id'];
//        $selectedShipping   = $request['transaction_time'];
//        $selectedShipping   = $request['fraud_status'];
//        $selectedShipping   = $request['bank'];
//        $selectedShipping   = $request['permata_va_number'];
//        $selectedShipping   = $request['signature_key'];
//        $selectedShipping   = $request['masked_card'];
//        $selectedShipping   = $request['bill_key'];
//        $selectedShipping   = $request['biller_code'];

        $midJsonBody = json_decode($request);

        $dateTimeNow = Carbon::now('Asia/Jakarta');
        $transactionDB = Transaction::where('order_id', '=', $midJsonBody->order_id)->first();

        if($midJsonBody->status_code == 200){
            $transactionDB->accept_date = $dateTimeNow->toDateTimeString();
            $transactionDB->status_id = 5;


            $emailBody = new EmailTransactionNotif();
            Mail::to('yansen626@gmail.com')->send($emailBody);
        }
        else if($midJsonBody->status_code == 202){
            $transactionDB->status_id = 10;
        }

        $transactionDB->modified_on = $dateTimeNow->toDateTimeString();
        $transactionDB->save();
    }
}