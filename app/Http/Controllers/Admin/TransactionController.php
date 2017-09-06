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
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Session;

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
}