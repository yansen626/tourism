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
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function index(){
        if(Session::has('admin_id')){
            $transactions = Transaction::all();

            return View('admin.show-transactions', compact('transactions'));
        }
        else{
            return redirect()->route('login-admin');
        }
    }
}