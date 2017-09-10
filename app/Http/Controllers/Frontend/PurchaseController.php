<?php
/**
 * Created by PhpStorm.
 * User: hellb
 * Date: 9/9/2017
 * Time: 1:32 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Transaction;

class PurchaseController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    public function showTransferConfirm(){
        //$id = Auth::user()->id;
        $id = '8c4d3607-8d60-11e7-afa8-7085c23fc9a7';
        $transactions = Transaction::where('user_id', $id)->where('status_id', 4)->orderByDesc('created_on')->get();

        return View('frontend.show-transfers', compact('transactions'));
    }

    public function invoice(){
        return View('frontend.show-invoice');
    }
}