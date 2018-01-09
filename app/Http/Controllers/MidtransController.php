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
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

//            Utilities::ExceptionLog('ORDER ID = '. $notif->order_id);
            $orderid = $notif->order_id;

            sleep(15);

            DB::transaction(function() use ($orderid, $json){

                Utilities::ExceptionLog($json);
                Utilities::ExceptionLog($orderid);

                $dateTimeNow = Carbon::now('Asia/Jakarta');

                if($json->status_code == "200"){
                    if(($json->transaction_status == "capture" || $json->transaction_status == "accept") && $json->fraud_status == "accept"){
                        $transaction = Transaction::where('order_id', $orderid)->first();
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

                          // Decrease product stock
//                        $products = Product::all();
//                        foreach($transaction->transaction_details as $detail){
//                            $product = $products->where('id', $detail->product_id)->first();
//                            $product->quantity -= 1;
//                            $product->save();
//                        }
                    }

                    $transaction->modified_on = $dateTimeNow->toDateTimeString();
                    $transaction->save();
                }
                else if($json->status_code == "201"){
                    // Filter payment type
                    if($json->payment_type == "bank_transfer"){
                        $transaction = Transaction::where('order_id', $orderid)->first();
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
                        $transaction = Transaction::where('order_id', $orderid)->first();
                        $transaction->bill_key = $json->bill_key;
                        $transaction->biller_code = $json->biller_code;
                    }
                    else if($json->payment_type == "credit_card"){
                        $transaction = Transaction::where('order_id', $orderid)->first();
                        $transaction->status_id = 11;
                    }

                    $transaction->modified_on = $dateTimeNow->toDateTimeString();
                    $transaction->save();
                }
                else if($json->status_code == "202"){
                    $transaction = Transaction::where('order_id', $orderid)->first();
                    $transaction->status_id = 10;
                    $transaction->modified_on = $dateTimeNow->toDateTimeString();
                    $transaction->save();
                }
                else{
                    // Log error exception here
                }
            }, 5);
        }
        catch (\Exception $ex){
            Utilities::ExceptionLog($ex);
        }
    }

    // Midtrans payment success redirect for CC payment
    public function success($userId){
        try
        {
            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $carts = Cart::where('user_id', $userId)->get();
            $userData = User::find($userId);
            $userAddress = Address::where('user_id', $userId)->first();

            $totalPrice = 0;
            $totalWeight = 0;

            // Get order id from GET parameter
            $orderId = \request()->order_id;

            // Filter product property & sum all weights
            foreach ($carts as $cart) {
                if(!empty($cart->size_option) && empty($cart->weight_option) && empty($cart->qty_option)){
                    $sizeProperty = $cart->product->product_properties()->where('name','=','size')
                        ->where('description', $cart->size_option)
                        ->first();

                    if(!empty($sizeProperty->price)){
                        $price = $sizeProperty->getOriginal('price');

                        if($cart->getOriginal('price') != $sizeProperty->getOriginal('price')){
                            $cart->price = $sizeProperty->getOriginal('price');
                            $cart->save();
                        }
                    }
                    else{
                        $price = $cart->product->getOriginal('price_discounted');
                    }

                    $weight = $sizeProperty->weight;
                }
                elseif(empty($cart->size_option) && !empty($cart->weight_option) && empty($cart->qty_option)){
                    $weightProperty = $cart->product->product_properties()->where('name','=','weight')
                        ->where('description', $cart->weight_option)
                        ->first();

                    if(!empty($weightProperty->price)){
                        $price = $weightProperty->getOriginal('price');

                        if($cart->getOriginal('price') != $weightProperty->getOriginal('price')){
                            $cart->price = $weightProperty->getOriginal('price');
                            $cart->save();
                        }
                    }
                    else{
                        $price = $weightProperty->product->getOriginal('price_discounted');
                    }

                    if(!empty($weightProperty->price)){
                        $weight = (intval($weightProperty->description) * $cart->quantity);
                    }
                    else{
                        $weight = ($cart->product->weight * $cart->quantity);
                    }
                }
                elseif(empty($cart->size_option) && empty($cart->weight_option) && !empty($cart->qty_option)){
                    $qtyProperty = $cart->product->product_properties()->where('name','=','qty')
                        ->where('description', $cart->qty_option)
                        ->first();

                    if(!empty($qtyProperty->price)){
                        $price = $qtyProperty->getOriginal('price');

                        if($cart->getOriginal('price') != $qtyProperty->getOriginal('price')){
                            $cart->price = $qtyProperty->getOriginal('price');
                            $cart->save();
                        }
                    }
                    else{
                        $price = $qtyProperty->product->getOriginal('price_discounted');
                    }

                    $weight = $qtyProperty->weight * $cart->quantity;
                }
                else{
                    $price = $cart->product->getOriginal('price_discounted');
                    $weight = $cart->product->weight;
                }

                $subtotalPrice = $price * $cart->quantity;
                if($cart->getOriginal('total_price') != $subtotalPrice){
                    $cart->total_price = $subtotalPrice;
                    $cart->save();
                }

                $totalPrice += $subtotalPrice;
                $deliveryFee = (int)$cart->getOriginal('delivery_fee');
                $adminFee = (int)$cart->getOriginal('admin_fee');

                $subtotalWeight = $weight * $cart->quantity;
                $totalWeight += $subtotalWeight;
            }
            $totalPriceWithDeliveryFeeAdminFee = $totalPrice + $deliveryFee + $adminFee;

            //insert into transactions DB
            $transaction = Transaction::create([
                'id'                => Uuid::generate(),
                'user_id'           => $userId,
                'order_id'          => $orderId,
                'payment_method_id' => 2,
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

                // Check Property Option
                if(!empty($cart->size_option) && empty($cart->weight_option) && empty($cart->qty_option)){
                    $transactionDetail->size_option = $cart->size_option;
                    $transactionDetail->size_option_price = $cart->getOriginal('price');
                    $transactionDetail->price_final = $cart->getOriginal('price');
                }
                elseif(empty($cart->size_option) && !empty($cart->weight_option) && empty($cart->qty_option)){
                    $transactionDetail->weight_option = $cart->weight_option;
                    $transactionDetail->weight_option_price = $cart->getOriginal('price');
                    $transactionDetail->price_final = $cart->getOriginal('price');
                    $transactionDetail->weight = $cart->weight_option;
                }
                elseif(empty($cart->size_option) && empty($cart->weight_option) && !empty($cart->qty_option)){
                    $transactionDetail->qty_option = $cart->qty_option;
                    $transactionDetail->qty_option_price = $cart->getOriginal('price');
                    $transactionDetail->price_final = $cart->getOriginal('price');

                    $qty = $cart->product->product_properties()->where('name','=','qty')
                        ->where('description', $cart->qty_option)
                        ->first();

                    $transactionDetail->weight = $qty->weight;
                }
                else{
                    if (!empty ($cart->product->discount)) {
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
                }

                if(!empty($cart->note)){
                    $transactionDetail->note = $cart->note;
                }

                // Check buyer note
                if(!empty($cart->buyer_note)){
                    $transactionDetail->buyer_note = $cart->buyer_note;
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


            return redirect()->route('checkout-success', ['paymentMethod' => 'credit_card']);
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
                return redirect()->route('checkout4')->withErrors('Select your payment method');
            }

            $enabledPayments = Input::get('payment');

            $adminFee   = (int)$request['selected-fee'];

            // Get unique order id
            $orderId = uniqid();

            $carts = Cart::where('user_id', $userId)->get();

            // Check final stock
//            foreach($carts as $cart){
//                if($cart->product->quantity == 0){
//                    return redirect()->route('checkout4', ['ex' => 'stock']);
//                }
//            }
            $paymentMethod = 3;
            if($enabledPayments == 'credit_card'){
                $paymentMethod = 2;
            }
            else if($enabledPayments == 'bank_transfer'){
                $paymentMethod = 1;
            }
            else {
                $paymentMethod = 3;
            }

            foreach($carts as $cart){
                $cart->payment_method = $paymentMethod;
//                $cart->payment_method = $enabledPayments == 'credit_card'? 2:1;
                $cart->admin_fee = $adminFee;
                $cart->save();
            }

            $cartsToMidtrans = $carts;

            if($enabledPayments == 'bank_transfer' || $enabledPayments == 'manual_transfer'){
                //transactions data
                $dateTimeNow = Carbon::now('Asia/Jakarta');
                $carts = Cart::where('user_id', $userId)->get();
                $userData = User::find($userId);
                $userAddress = Address::where('user_id', $userId)->first();

                $totalPrice = 0;
                $totalWeight = 0;

                foreach ($carts as $cart) {
                    if(!empty($cart->size_option) && empty($cart->weight_option) && empty($cart->qty_option)){
                        $sizeProperty = $cart->product->product_properties()->where('name','=','size')
                            ->where('description', $cart->size_option)
                            ->first();

                        if(!empty($sizeProperty->price)){
                            $price = $sizeProperty->getOriginal('price');

                            if($cart->getOriginal('price') != $sizeProperty->getOriginal('price')){
                                $cart->price = $sizeProperty->getOriginal('price');
                                $cart->save();
                            }
                        }
                        else{
                            $price = $cart->product->getOriginal('price_discounted');
                        }

                        if(!empty($sizeProperty->weight)){
                            $weight = $sizeProperty->weight;
                        }
                        else{
                            $weight = $cart->product->weight;
                        }
                    }
                    elseif(empty($cart->size_option) && !empty($cart->weight_option) && empty($cart->qty_option)){
                        $weightProperty = $cart->product->product_properties()->where('name','=','weight')
                            ->where('description', $cart->weight_option)
                            ->first();

                        if(!empty($weightProperty->price)){
                            $price = $weightProperty->getOriginal('price');

                            if($cart->getOriginal('price') != $weightProperty->getOriginal('price')){
                                $cart->price = $weightProperty->getOriginal('price');
                                $cart->save();
                            }
                        }
                        else{
                            $price = $weightProperty->product->getOriginal('price_discounted');
                        }

                        $weight = intval($weightProperty->description);
                    }
                    elseif(empty($cart->size_option) && empty($cart->weight_option) && !empty($cart->qty_option)){
                        $qtyProperty = $cart->product->product_properties()->where('name','=','qty')
                            ->where('description', $cart->qty_option)
                            ->first();

                        if(!empty($qtyProperty->price)){
                            $price = $qtyProperty->getOriginal('price');

                            if($cart->getOriginal('price') != $qtyProperty->getOriginal('price')){
                                $cart->price = $qtyProperty->getOriginal('price');
                                $cart->save();
                            }
                        }
                        else{
                            $price = $qtyProperty->product->getOriginal('price_discounted');
                        }

                        $weight = $qtyProperty->weight;
                    }
                    else{
                        $price = $cart->product->getOriginal('price_discounted');
                        $weight = $cart->product->weight;
                    }

                    $subtotalPrice = $price * $cart->quantity;
                    if($cart->getOriginal('total_price') != $subtotalPrice){
                        $cart->total_price = $subtotalPrice;
                        $cart->save();
                    }

                    $totalPrice += $subtotalPrice;
                    $deliveryFee = (int)$cart->getOriginal('delivery_fee');
                    $adminFee = (int)$cart->getOriginal('admin_fee');

                    $subtotalWeight = $weight * $cart->quantity;
                    $totalWeight += $subtotalWeight;
                }
                $totalPriceWithDeliveryFeeAdminFee = $totalPrice + $deliveryFee + $adminFee;

                //insert into transactions DB
                $transaction = Transaction::create([
                    'id'                => Uuid::generate(),
                    'user_id'           => $userId,
                    'order_id'          => $orderId,
                    'payment_method_id' => $paymentMethod,
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

                    // Check Property Option
                    if(!empty($cart->size_option) && empty($cart->weight_option) && empty($cart->qty_option)){
                        $transactionDetail->size_option = $cart->size_option;
                        $transactionDetail->size_option_price = $cart->getOriginal('price');
                        $transactionDetail->price_final = $cart->getOriginal('price');
                    }
                    elseif(empty($cart->size_option) && !empty($cart->weight_option) && empty($cart->qty_option)){
                        $transactionDetail->weight_option = $cart->weight_option;
                        $transactionDetail->weight_option_price = $cart->getOriginal('price');
                        $transactionDetail->price_final = $cart->getOriginal('price');
                        $transactionDetail->weight = $cart->weight_option;
                    }
                    elseif(empty($cart->size_option) && empty($cart->weight_option) && !empty($cart->qty_option)){
                        $transactionDetail->qty_option = $cart->qty_option;
                        $transactionDetail->qty_option_price = $cart->getOriginal('price');
                        $transactionDetail->price_final = $cart->getOriginal('price');

                        $qty = $cart->product->product_properties()->where('name','=','qty')
                            ->where('description', $cart->qty_option)
                            ->first();

                        $transactionDetail->weight = $qty->weight;
                    }
                    else{
                        if (!empty ($cart->product->discount)) {
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
                    }

                    if(!empty($cart->note)){
                        $transactionDetail->note = $cart->note;
                    }

                    // Check buyer note
                    if(!empty($cart->buyer_note)){
                        $transactionDetail->buyer_note = $cart->buyer_note;
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

            //if payment select manual transfer redirect to account bank view
            if($enabledPayments == "manual_transfer"){
                return redirect()->route('checkout-bank-account');
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

    public function checkoutSuccess($paymentMethod){
        return View('frontend.checkout-success', compact('paymentMethod'));
    }
}