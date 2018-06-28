<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 30/08/2017
 * Time: 15:31
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\libs\RajaOngkir;
use App\Mail\DeliveryConfirm;
use App\Mail\OrderAccepted;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionHeader;
use App\Models\TransferConfirmation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function index(){
        $transactions = TransactionHeader::all()->sortByDesc('created_on');

        return View('admin.transactions.show-transactions', compact('transactions'));
    }

    public function detail($id){
        $transaction = TransactionHeader::find($id);

        return View('admin.transactions.show-transaction-details', compact('transaction'));
    }

    public function newOrder(){
        $transactions = TransactionHeader::where('status_id', 5)->orderByDesc('created_at')->get();

        return View('admin.transactions.show-new-orders', compact('transactions'));
    }

    public function acceptOrder($id){
        $trx = TransactionHeader::find($id);

        $trx->status_id = 6;
        $trx->save();

        Mail::to($trx->user->email)->send(new OrderAccepted());

        Session::flash('message', 'Order baru telah di terima!');

        return redirect::route('new-order-list');
    }

    public function rejectOrder(Request $request){
        $trx = TransactionHeader::find(Input::get('reject-trx-id'));

        $trx->status_id = 10;
        if(!empty(Input::get('reject-reason'))){
            $trx->reject_note = Input::get('reject-reason');
        }
        $trx->save();

        // Return product stock
//        $products = Product::all();
//        foreach($trx->transaction_details as $detail){
//            $product = $products->where('id', $detail->product_id)->first();
//            $product->quantity += 1;
//            $product->save();
//        }

        Session::flash('message', 'Order baru telah di tolak!');

        return redirect::route('new-order-list');
    }

    public function payment(){
        //$transfers = TransferConfirmation::where('status_id', 4)->get();
        $transactions = TransactionHeader::where('status_id', 3)
            ->orWhere('status_id', 4)
            ->orWhere('status_id', 11)
            ->orderByDesc('created_at')->get();

        return View('admin.transactions.show-payments', compact('transactions'));
    }

    public function manualTransferPayment(){
        $transfers = TransferConfirmation::where('status_id', 3)->get();
//        $transactions = Transaction::where('status_id', 3)
//            ->orWhere('status_id', 4)
//            ->orWhere('status_id', 11)
//            ->orderByDesc('created_on')->get();

        return View('admin.transactions.show-manual-payments', compact('transfers'));
    }

    public function confirmPayment($id){
        $trans = TransferConfirmation::find($id);

        $trans->status_id = 5;
        $trans->save();

        $trx = Transaction::find($trans->transaction_id);
        $trx->status_id = 5;
        $trx->save();

        Session::flash('message', 'Sukses konfirmasi transfer bank!');

        return redirect::route('payment-list');
    }

    public function cancelPayment($id){
        $trx = Transaction::find($id);
        $trx->status_id = 10;
        $trx->finish_date = Carbon::now('Asia/Jakarta')->toDateTimeString();
        $trx->save();

        Session::flash('message', 'Pembayaran telah di tolak!');

        return redirect::route('payment-list');
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

        Mail::to($trx->user->email)->send(new DeliveryConfirm(Input::get('tracking-code')));

        Session::flash('message', 'Berhasil input nomor resi!');

        return redirect::route('delivery-list');
    }

    public function invoice($trxId){
        $trx = Transaction::find($trxId);

        return View('frontend.transactions.show-invoice', compact('trx'));
    }
}