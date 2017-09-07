<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 9/5/2017
 * Time: 1:59 PM
 */

namespace App\Http\Controllers\Frontend;



use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

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
    public function AddToCart(Request $request){
        //userId sesuai dengan session
        $userId = "8c4d3607-8d60-11e7-afa8-7085c23fc9a7";

        $productId   = $request['product_id'];
        $alreadyInCart = Cart::where([['user_id', '=', $userId], ['product_id', '=', $productId]])->first();
        if($alreadyInCart){
            $CartDB = Cart::where([['user_id', '=', $userId], ['product_id', '=', $productId]])->first();
            $CartDB->quantity = $CartDB->quantity + 1;

            $CartDB->save();
        }
        else{
            $singleProduct = Product::find($productId);

            Cart::Create([
                'product_id' => $productId,
                'user_id' => $userId,
                'quantity' => 1,
                'total_price' => $singleProduct->getOriginal('price')
            ]);

        }
        return null;
    }

    //
    public function DeleteCart(Request $request){
        $cartId   = $request['cart_id'];

        Cart::where('id', '=', $cartId)->delete();

        return null;
    }

    //
    public function EditQuantityCart(Request $request){
        //userId sesuai dengan session
        $userId = "8c4d3607-8d60-11e7-afa8-7085c23fc9a7";

        $cartId   = $request['cart_id'];
        $quantity   = $request['quantity'];

        $CartDB = Cart::find($cartId);
        $CartDB->quantity = $quantity;

        $CartDB->save();

        return null;
    }
}