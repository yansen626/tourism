<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 30/08/2017
 * Time: 15:31
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransferConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    public function index(){
        $transactions = Transaction::all()->sortByDesc('created_on');

        return View('admin.show-transactions', compact('transactions'));
    }

    public function detail($id){
        $transaction = Transaction::find($id);

        return View('admin.show-transaction-details', compact('transaction'));
    }

    public function newOrder(){
        $transactions = Transaction::where('status_id', 5)->orderByDesc('created_on')->get();

        return View('admin.show-new-orders', compact('transactions'));
    }

    public function acceptOrder($id){
        $trx = Transaction::find($id);

        $trx->status_id = 6;
        $trx->save();

        return redirect::route('new-order-list');
    }

    public function rejectOrder(Request $request){
        $trx = Transaction::find(Input::get('reject-trx-id'));

        $trx->status_id = 7;
        if(!empty(Input::get('reject-reason'))){
            $trx->reject_note = Input::get('reject-reason');
        }
        $trx->save();

        return redirect::route('new-order-list');
    }

    public function userTransfer(){
        $transfers = TransferConfirmation::where('status_id', 3)->get();

        return View('admin.show-user-transfers', compact('transfers'));
    }

    public function confirmTransfer($id){
        $trans = TransferConfirmation::find($id);

        $trans->status_id = 5;
        $trans->save();

        $trx = Transaction::find($trans->trx_id);
        $trx->status_id = 5;
        $trx->save();

        return redirect::route('transfer-list');
    }

    public function deliveryRequest(){
        $transactions = Transaction::where('status_id', 6)->get();

        return View('admin.show-delivery-requests', compact('transactions'));
    }

    public function confirmDelivery(Request $request){
        $trx = Transaction::find(Input::get('delivery-trx-id'));

        $trx->tracking_code = Input::get('tracking-code');
        $trx->status_id = 9;
        $trx->save();

        return redirect::route('delivery-list');
    }
}