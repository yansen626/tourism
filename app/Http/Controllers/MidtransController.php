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
use App\Models\Transaction;
use App\Notifications\TransactionNotify;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Http\Message\ServerRequestInterface;

class MidtransController extends Controller
{
    public function notification(ServerRequestInterface $request){
        try
        {
            $tmp = json_decode($request->getBody());
            $json = json_decode($tmp);

            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $trx = Transaction::where('order_id', $json->order_id)->first();

            if($json->status_code == 200){
                if(($json->transaction_status == "capture" || $json->transaction_status =="accept") && $json->fraud_status == "accept"){
                    $trx->accept_date = $dateTimeNow->toDateTimeString();
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
            else if($json->status_code == 201){
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
                    $trx->bill_key = $json->bill_key;
                    $trx->biller_code = $json->biller_code;
                }

                $trx->status_id = 11;
            }
            else if($json->status_code == 202){
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
}