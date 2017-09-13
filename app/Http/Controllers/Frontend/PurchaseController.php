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
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function payment(){
        $id = Auth::user()->id;

        $start = Carbon::today('Asia/Jakarta')->subMonth(3);
        $end = Carbon::today('Asia/Jakarta')->addMonths(3);

        if(!empty(request()->start) && !empty(request()->end)){
            $start = Carbon::createFromFormat('d/m/Y', request()->start, 'Asia/Jakarta');
            $end = Carbon::createFromFormat('d/m/Y', request()->end, 'Asia/Jakarta');

            if(!empty(request()->search)){
                $transactions = Transaction::where('user_id', $id)
                    ->where(function($query){
                        $query->where('status_id', 3)
                            ->orWhere('status_id', 4);
                    })
                    ->whereBetween('created_on', [$start->toDateString(),$end->toDateString()])
                    ->where('invoice','LIKE','%'. request()->search. '%')
                    ->orderByDesc('created_on')->get();
            }else{
                $transactions = Transaction::where('user_id', $id)
                    ->where(function($query){
                        $query->where('status_id', 3)
                            ->orWhere('status_id', 4);
                    })
                    ->whereBetween('created_on', [$start->toDateString(),$end->toDateString()])
                    ->orderByDesc('created_on')->get();
            }
        }
        else{
            $transactions = Transaction::where('user_id', $id)
                ->where(function($query){
                    $query->where('status_id', 3)
                        ->orWhere('status_id', 4);
                })
                ->whereBetween('created_on', [$start->toDateString(),$end->toDateString()])
                ->orderByDesc('created_on')->get();
        }

        $data = [
            'transactions'  => $transactions,
            'date_start'    => $start->format('d/m/Y'),
            'date_end'      => $end->format('d/m/Y')
        ];

        return View('frontend.show-payments')->with($data);
    }

    public function invoice($id){
        $trx = Transaction::find($id);

        return View('frontend.show-invoice', compact('trx'));
    }

    public function order(){
        $id = Auth::user()->id;

        $start = Carbon::today('Asia/Jakarta')->subMonth(3);
        $end = Carbon::today('Asia/Jakarta')->addMonths(3);

        if(!empty(request()->start) && !empty(request()->end)){
            $start = Carbon::createFromFormat('d/m/Y', request()->start, 'Asia/Jakarta');
            $end = Carbon::createFromFormat('d/m/Y', request()->end, 'Asia/Jakarta');

            if(!empty(request()->search)){
                $transactions = Transaction::where('user_id', $id)
                    ->where('status_id', '!=', 3)
                    ->where('status_id', '!=', 9)
                    ->where('status_id', '!=', 10)
                    ->whereBetween('created_on', [$start->toDateString(),$end->toDateString()])
                    ->where('invoice','LIKE','%'. request()->search. '%')
                    ->orderByDesc('created_on')->get();
            }else{
                $transactions = Transaction::where('user_id', $id)
                    ->where('status_id', '!=', 3)
                    ->where('status_id', '!=', 9)
                    ->where('status_id', '!=', 10)
                    ->whereBetween('created_on', [$start->toDateString(),$end->toDateString()])
                    ->orderByDesc('created_on')->get();
            }
        }
        else{
            $transactions = Transaction::where('user_id', $id)
                ->where('status_id', '!=', 3)
                ->where('status_id', '!=', 9)
                ->where('status_id', '!=', 10)
                ->whereBetween('created_on', [$start->toDateString(),$end->toDateString()])
                ->orderByDesc('created_on')->get();
        }

        $data = [
            'transactions'  => $transactions,
            'date_start'    => $start->format('d/m/Y'),
            'date_end'      => $end->format('d/m/Y')
        ];

        return View('frontend.show-orders')->with($data);
    }

    public function history(){
        $id = Auth::user()->id;

        $start = Carbon::today('Asia/Jakarta')->subMonth(3);
        $end = Carbon::today('Asia/Jakarta')->addMonths(3);

        if(!empty(request()->start) && !empty(request()->end)){
            $start = Carbon::createFromFormat('d/m/Y', request()->start, 'Asia/Jakarta');
            $end = Carbon::createFromFormat('d/m/Y', request()->end, 'Asia/Jakarta');

            if(!empty(request()->search)){
                $transactions = Transaction::where('user_id', $id)
                    ->where('status_id', '!=', 3)
                    ->where('status_id', '!=', 4)
                    ->whereBetween('created_on', [$start->toDateString(),$end->toDateString()])
                    ->where('invoice','LIKE','%'. request()->search. '%')
                    ->orderByDesc('created_on')->get();
            }else{
                $transactions = Transaction::where('user_id', $id)
                    ->where('status_id', '!=', 3)
                    ->where('status_id', '!=', 4)
                    ->whereBetween('created_on', [$start->toDateString(),$end->toDateString()])
                    ->orderByDesc('created_on')->get();
            }
        }
        else{
            $transactions = Transaction::where('user_id', $id)
                ->where('status_id', '!=', 3)
                ->where('status_id', '!=', 4)
                ->whereBetween('created_on', [$start->toDateString(),$end->toDateString()])
                ->orderByDesc('created_on')->get();
        }

        $data = [
            'transactions'  => $transactions,
            'date_start'    => $start->format('d/m/Y'),
            'date_end'      => $end->format('d/m/Y')
        ];

        return View('frontend.show-order-histories')->with($data);
    }
}