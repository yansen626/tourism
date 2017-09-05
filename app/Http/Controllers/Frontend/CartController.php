<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 9/5/2017
 * Time: 1:59 PM
 */

namespace App\Http\Controllers\Frontend;


class CartController
{
    //
    public function AddtoCart(){
        return view('frontend.carts');
    }
    //
    public function CartShowAll(){
        return view('frontend.carts');
    }

}