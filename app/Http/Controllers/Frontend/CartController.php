<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 9/5/2017
 * Time: 1:59 PM
 */

namespace App\Http\Controllers\Frontend;


use App\Models\Cart;

class CartController
{
    //
    public function CartShowAll(){
        //userId sesuai dengan session
        $userId = "8c4d3607-8d60-11e7-afa8-7085c23fc9a7";

        $carts = Cart::where('user_id', 'like', $userId)->get();

        $totalPriceTem = Cart::where('user_id', 'like', $userId)->sum('total_price');
        $totalPrice = number_format($totalPriceTem, 0, ",", ".");

        return view('frontend.carts', compact('carts','totalPrice'));
    }

    //
    public function AddToCart(){
        return view('frontend.carts');
    }

    //
    public function DeleteCart(){
        return view('frontend.carts');
    }
}