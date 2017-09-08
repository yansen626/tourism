<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 8/31/2017
 * Time: 11:29 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Models\Address;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    //
    public function CheckoutProcess1(){

        $id = Auth::user()->id;
        $data = Address::where('user_id', $id)->first();

        return view('frontend.checkout-step1', compact('data'));
    }


    //
    public function CheckoutProcess2(){
        return view('frontend.checkout-step2');
    }
    //
    public function CheckoutProcess3(){
        return view('frontend.checkout-step3');
    }
    //
    public function CheckoutProcess4(){
        return view('frontend.checkout-step4');
    }
}