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
}