<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 19/09/2017
 * Time: 13:46
 */

namespace App\Http\Controllers;


use App\libs\Utilities;
use App\Mail\EmailTransactionNotif;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use App\Notifications\TransactionNotify;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Http\Message\ServerRequestInterface;
use Webpatser\Uuid\Uuid;

class MidtransController extends Controller
{
    public function notification(ServerRequestInterface $request){
        try
        {
            //$tmp = json_decode($request->getBody());
            $json = json_decode($request->getBody());

            Utilities::ExceptionLog($json);
            Utilities::ExceptionLog($json->order_id);

            $tmp = $json->order_id;

            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $trx = Transaction::where('order_id', strval($tmp))->first();
            //$trx = DB::table('transactions')->where('order_id', 'like', '%' .$tmp. '%')->first();


            Utilities::ExceptionLog($trx);

            if($json->status_code == "200"){
                if(($json->transaction_status == "capture" || $json->transaction_status =="accept") && $json->fraud_status == "accept"){
                    //$trx->accept_date = $dateTimeNow->toDateTimeString();
                    $trx->status_id = 5;

                    // Filter payment type
                    if($json->payment_type == "bank_transfer"){
                        // Filter bank
                        if(!empty($json->permata_va_number)){
                            $trx->va_bank = "permata";
                            $trx->va_number = $json->permata_va_number;
                        }
                        else if(!empty($json->va_numbers)){
                            $trx->va_bank = $json->va_numbers->bank;
                            $trx->va_number = $json->va_numbers->va_number;
                        }
                    }
                    else if($json->payment_type == "echannel"){
                        $trx->va_bank = "mandiri";
                        $trx->bill_key = $json->bill_key;
                        $trx->biller_code = $json->biller_code;
                    }

                    //send email to notify buyer transaction success
                    $userMail = $trx->user->email;
                    $userMail->notify(new TransactionNotify($trx));

                    //send email to notify admin new transaction
                    $userMail = "yansen626@gmail.com";
                    $emailBody = new EmailTransactionNotif();
                    Mail::to($userMail)->send($emailBody);
                }
            }
            else if($json->status_code == "201"){
                // Filter payment type
                if($json->payment_type == "bank_transfer"){
                    $trx->status_id = 4;

                    // Filter bank
                    if(!empty($json->permata_va_number)){
                        $trx->va_bank = "permata";
                        $trx->va_number = $json->permata_va_number;
                    }
                    else if(!empty($json->va_numbers)){
                        $trx->va_bank = $json->va_numbers->bank;
                        $trx->va_number = $json->va_numbers->va_number;
                    }
                }
                else if($json->payment_type == "echannel"){
                    $trx->bill_key = $json->bill_key;
                    $trx->biller_code = $json->biller_code;
                }

                $trx->status_id = 11;
            }
            else if($json->status_code == "202"){
                $trx->status_id = 10;
            }
            else{
                // Log error exception here
            }

            $trx->modified_on = $dateTimeNow->toDateTimeString();
            $trx->save();
        }
        catch (\Exception $ex){
            Utilities::ExceptionLog($ex);
        }
    }

    //payment online success
    public function success($userId){
        try{
            //transactions data
            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $carts = Cart::where('user_id', $userId)->get();
            $userData = User::find($userId);
            $userAddress = Address::where('user_id', $userId)->first();

            $totalPrice = 0;

            foreach ($carts as $cart) {
                //$totalPriceDB = (int)$cart->getOriginal('total_price');
                $subtotalPrice = $cart->product->getOriginal('price_discounted') * $cart->quantity;
                $totalPrice += $subtotalPrice;
                $orderId = $cart->order_id;
                $deliveryFee = (int)$cart->getOriginal('delivery_fee');
                $adminFee = (int)$cart->getOriginal('admin_fee');
                $paymentMethod = $cart->payment_method;
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

            return redirect()->route('user-payment-list');
        }
        catch(\Exception $ex){
            Utilities::ExceptionLog($ex);
        }
    }
}