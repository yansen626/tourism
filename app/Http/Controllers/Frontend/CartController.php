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
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController
{
    //
    public function CartShowAll(){
        //userId sesuai dengan session
        $user = Auth::user();
        $userId = $user->id;

        $carts = Cart::where('user_id', 'like', $userId)->get();

        $totalPriceTem = Cart::where('user_id', 'like', $userId)->sum('total_price');
        $totalPrice = number_format($totalPriceTem, 0, ",", ".");

        return view('frontend.carts', compact('carts','totalPrice', 'totalPriceTem'));
    }

    //
    public function AddToCart(Request $request){
        //userId sesuai dengan session
        $user = Auth::user();
        $userId = $user->id;

        $productId   = $request['product_id'];
        $alreadyInCart = Cart::where([['user_id', '=', $userId], ['product_id', '=', $productId]])->first();
        if($alreadyInCart){
            $CartDB = Cart::where([['user_id', '=', $userId], ['product_id', '=', $productId]])->first();
            $price = $CartDB->getOriginal('total_price') / $CartDB->quantity;
            $newQuantity = $CartDB->quantity + 1;
            $CartDB->quantity = $newQuantity;
            $CartDB->total_price = $newQuantity * $price;

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

        //edit session data
        $userId = Auth::user()->id;
        $carts = Cart::where('user_id', 'like', $userId)->get();
        $cartTotal = $carts->count();
        Session::put('cartList', $carts);
        Session::put('cartTotal', $cartTotal);

        return null;
    }

    //
    public function DeleteCart($cartId){
//        $cartDB = Cart::find($cartId);
//
//        $totalPriceTem = Cart::where('user_id', 'like', $cartDB->user_id)->sum('total_price');
//        $totalPrice = number_format($totalPriceTem, 0, ",", ".");

        Cart::where('id', '=', $cartId)->delete();

        //edit session data
        $userId = Auth::user()->id;
        $carts = Cart::where('user_id', 'like', $userId)->get();
        $cartTotal = $carts->count();
        Session::put('cartList', $carts);
        Session::put('cartTotal', $cartTotal);

        return redirect()->route('cart-list');
    }

    //
    public function EditQuantityCart(Request $request){
        //userId sesuai dengan session
        $user = Auth::user();
        $userId = $user->id;

        $cartId   = $request['cart_id'];
        $quantity   = $request['quantity'];

        $CartDB = Cart::find($cartId);

        $price = $CartDB->getOriginal('total_price') / $CartDB->quantity;
        $newSinglePrice = $quantity * $price;
        $newSinglePriceFormated = number_format($newSinglePrice, 0, ",", ".");

        $CartDB->quantity = $quantity;
        $CartDB->total_price = $newSinglePrice;
        $CartDB->save();

        $totalPriceTem = Cart::where('user_id', 'like', $userId)->sum('total_price');
        $newTotalPriceFormated = number_format($totalPriceTem, 0, ",", ".");

        //edit session data
        $carts = Cart::where('user_id', 'like', $userId)->get();
        $cartTotal = $carts->count();
        Session::put('cartList', $carts);
        Session::put('cartTotal', $cartTotal);

        return response()->json([
            'totalPrice' => $newTotalPriceFormated,
            'singlePrice' => $newSinglePriceFormated
        ]);
//        return ['totalPrice' => $newTotalPriceFormated,'singlePrice' => $newSinglePriceFormated];
    }
}