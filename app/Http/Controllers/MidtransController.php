<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 19/09/2017
 * Time: 13:46
 */

namespace App\Http\Controllers;

use App\libs\Midtrans;
use App\libs\Utilities;
use App\libs\Veritrans;
use App\Mail\NewOrderAdmin;
use App\Mail\NewOrderCustomer;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Webpatser\Uuid\Uuid;

class MidtransController extends Controller
{
    public function __construct(){
        Veritrans::$serverKey = env('MIDTRANS_API_KEY_SANDBOX');
        Veritrans::$isProduction = false;
    }

    public function notification(){
        try
        {
            $json_result = file_get_contents('php://input');
            $json = json_decode($json_result);

            Utilities::ExceptionLog($json);

            $vt = new Veritrans;
            $notif = $vt->status($json->order_id);

            Utilities::ExceptionLog('ORDER ID = '. $notif->order_id);

            $dateTimeNow = Carbon::now('Asia/Jakarta');

            $transaction = Transaction::where('order_id', $notif->order_id)->first();
            Utilities::ExceptionLog($transaction);

            if($json->status_code == "200"){
                if(($json->transaction_status == "capture" || $json->transaction_status =="accept") && $json->fraud_status == "accept"){
                    $transaction->status_id = 5;

                    // Filter payment type
                    if($json->payment_type == "bank_transfer"){
                        // Filter bank
                        if(!empty($json->permata_va_number)){
                            $transaction->va_bank = "permata";
                            $transaction->va_number = $json->permata_va_number;
                        }
                        else if(!empty($json->va_numbers)){
                            $transaction->va_bank = $json->va_numbers[0]->bank;
                            $transaction->va_number = $json->va_numbers[0]->va_number;
                        }
                    }
                    else if($json->payment_type == "echannel"){
                        $transaction->va_bank = "mandiri";
                        $transaction->bill_key = $json->bill_key;
                        $transaction->biller_code = $json->biller_code;
                    }
                    //
//                    //send email to notify admin new transaction
//                    $userMail = "hellbardx2@gmail.com";
//                    $emailBody = new NewOrderAdmin();
//                    Mail::to($userMail)->send($emailBody);

                    //$emailBody = new NewOrderCustomer($transaction);
                    Mail::to($transaction->user->email)->send(new NewOrderCustomer());
                    Mail::to('admin@lowids.com')->send(new NewOrderAdmin());
                }

                $transaction->modified_on = $dateTimeNow->toDateTimeString();
                $transaction->save();
            }
            else if($json->status_code == "201"){
                // Filter payment type
                if($json->payment_type == "bank_transfer"){
                    $transaction->status_id = 4;

                    // Filter bank
                    if(!empty($json->permata_va_number)){
                        $transaction->va_bank = "permata";
                        $transaction->va_number = $json->permata_va_number;
                    }
                    else if(!empty($json->va_numbers)){
                        $transaction->va_bank = $json->va_numbers[0]->bank;
                        $transaction->va_number = $json->va_numbers[0]->va_number;
                    }
                }
                else if($json->payment_type == "echannel"){
                    $transaction->bill_key = $json->bill_key;
                    $transaction->biller_code = $json->biller_code;
                }
                else if($json->payment_type == "credit_card"){
                    $transaction->status_id = 11;
                }

                $transaction->modified_on = $dateTimeNow->toDateTimeString();
                $transaction->save();
            }
            else if($json->status_code == "202"){
                $transaction->status_id = 10;
                $transaction->modified_on = $dateTimeNow->toDateTimeString();
                $transaction->save();
            }
            else{
                // Log error exception here
            }
        }
        catch (\Exception $ex){
            Utilities::ExceptionLog($ex);
        }
    }

    //payment online success
    public function success($userId){
        try{
            Utilities::ExceptionLog('USER ID = '. $userId);

            //transactions data
            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $carts = Cart::where('user_id', $userId)->get();
            $userData = User::find($userId);
            $userAddress = Address::where('user_id', $userId)->first();

            $totalPrice = 0;
            $totalWeight = 0;

            // Get order id from GET parameter
            $orderId = \request()->order_id;

            foreach ($carts as $cart) {
                $subtotalPrice = $cart->product->getOriginal('price_discounted') * $cart->quantity;
                $totalPrice += $subtotalPrice;
                $deliveryFee = (int)$cart->getOriginal('delivery_fee');
                $adminFee = (int)$cart->getOriginal('admin_fee');
                $paymentMethod = $cart->payment_method;

                $subtotalWeight = $cart->product->weight * $cart->quantity;
                $totalWeight += $subtotalWeight;
            }
            $totalPriceWithDeliveryFeeAdminFee = $totalPrice + $deliveryFee + $adminFee;

            $payMethod = 1;

            //insert into transactions DB
            $transaction = Transaction::create([
                'id'                => Uuid::generate(),
                'user_id'           => $userId,
                'order_id'          => $orderId,
                'payment_method_id' => $payMethod,
                'total_payment'     => $totalPriceWithDeliveryFeeAdminFee,
                'total_price'       => $totalPrice,
                'total_weight'      => $totalWeight,
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
                'delivery_fee'      => $deliveryFee,
                'admin_fee'         => $adminFee,
                'status_id'         => 3,
                'created_on'        => $dateTimeNow->toDateTimeString(),
                'created_by'        => $userId
            ]);

            if($paymentMethod == "credit_card"){
                $transaction->payment_method_id = 2;
                //$transaction->paid_date = $dateTimeNow->toDateTimeString();
                $transaction->status_id = 4;
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
                    'price_basic'       => $cart->product->getOriginal('price_discounted'),
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

            Session::forget('cartList');
            Session::forget('cartTotal');
            Session::pull('cartList');
            Session::pull('cartTotal');

            return redirect()->route('checkout-success');
        }
        catch(\Exception $ex){
            Utilities::ExceptionLog($ex);
        }
    }

    // Request to Midtrans
    public function checkoutMidtrans(Request $request){
        try{
            if(!Auth::check()){
                return Redirect::route('login');
            }
            $user = Auth::user();
            $userId = $user->id;

            if(empty(Input::get('payment'))){
                return redirect()->route('checkout4');
            }

            $enabledPayments = Input::get('payment');

            $adminFee   = (int)$request['selected-fee'];

            // Get unique order id
            $orderId = uniqid();

            $carts = Cart::where('user_id', $userId)->get();
            foreach($carts as $cart){
                $cart->payment_method = $enabledPayments == 'credit_card'? 2:1;
                $cart->admin_fee = $adminFee;
                $cart->save();
            }

            $cartsToMidtrans = $carts;

            if($enabledPayments == 'bank_transfer'){
                //transactions data
                $dateTimeNow = Carbon::now('Asia/Jakarta');
                $carts = Cart::where('user_id', $userId)->get();
                $userData = User::find($userId);
                $userAddress = Address::where('user_id', $userId)->first();

                $totalPrice = 0;
                $totalWeight = 0;

                foreach ($carts as $cart) {
                    $subtotalPrice = $cart->product->getOriginal('price_discounted') * $cart->quantity;
                    $totalPrice += $subtotalPrice;
                    $deliveryFee = (int)$cart->getOriginal('delivery_fee');
                    $adminFee = (int)$cart->getOriginal('admin_fee');

                    $subtotalWeight = $cart->product->weight * $cart->quantity;
                    $totalWeight += $subtotalWeight;
                }
                $totalPriceWithDeliveryFeeAdminFee = $totalPrice + $deliveryFee + $adminFee;


                //insert into transactions DB
                $transaction = Transaction::create([
                    'id'                => Uuid::generate(),
                    'user_id'           => $userId,
                    'order_id'          => $orderId,
                    'payment_method_id' => $enabledPayments == 'credit_card'? 2:1,
                    'total_payment'     => $totalPriceWithDeliveryFeeAdminFee,
                    'total_price'       => $totalPrice,
                    'total_weight'      => $totalWeight,
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
                    'delivery_fee'      => $deliveryFee,
                    'admin_fee'         => $adminFee,
                    'status_id'         => 3,
                    'created_on'        => $dateTimeNow->toDateTimeString(),
                    'created_by'        => $userId
                ]);

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
                        'price_basic'       => $cart->product->getOriginal('price_discounted'),
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

                Session::forget('cartList');
                Session::forget('cartTotal');
                Session::pull('cartList');
                Session::pull('cartTotal');
            }

            //set data to request
            $transactionDataArr = Midtrans::setRequestData($userId, $enabledPayments, $cartsToMidtrans, $orderId);

            //sending to midtrans
            $redirectUrl = Midtrans::sendRequest($transactionDataArr);

            return redirect($redirectUrl);
        }
        catch (\Exception $ex){
            Utilities::ExceptionLog('checkoutMidtrans EX = '. $ex);
        }
    }

    public function checkoutSuccess(){
        return View('frontend.checkout-success');
    }
}