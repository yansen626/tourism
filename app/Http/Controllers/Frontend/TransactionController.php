<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 8/31/2017
 * Time: 11:29 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    //
    public function CartsShowAll(){
        return view('frontend.carts');
    }

    //
    public function CheckoutProcess1(){
        return view('frontend.checkout-step1');
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