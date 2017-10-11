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
use App\Models\ProductProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController
{
    //
    public function CartShowAll(){
        if (Auth::check())
        {
            $userId = Auth::user()->id;

            $carts = Cart::where('user_id', $userId)->get();

            $totalPriceTem = Cart::where('user_id', $userId)->sum('total_price');
            $totalPrice = number_format($totalPriceTem, 0, ",", ".");

            return view('frontend.carts', compact('carts','totalPrice', 'totalPriceTem'));
        }
        else
        {
            return redirect()->route('login');
        }
    }

    //
    public function AddToCart(Request $request){
        try{
            if (!Auth::check()){
                return response()->json(['success' => false, 'error' => 'login']);
            }

            $user = Auth::user();
            $userId = $user->id;

            $productId   = $request['product_id'];

            $product = Product::find($productId);
//            if($product->quantity == 0){
//                return response()->json(['success' => false, 'error' => 'stock']);
//            }

            $note = "";
            if(!empty(Input::get('color'))){
                $color = ProductProperty::find(Input::get('color'));
                $note .= 'color='. $color->description. ';';
            }


            $carts = Cart::where([['user_id', '=', $userId], ['product_id', '=', $productId]])->get();

            if($carts > 0){
                $cart = Cart::where('user_id', $userId)->where('product_id', $productId);
                $isExist = false;

                // Get size selection
                if(!empty(Input::get('size')) && Input::get('size') != '0'){
                    $size = $product->product_properties()->where('name', '=', 'size')
                        ->where('description', Input::get('size'))
                        ->first();
                    $cart = $cart->where('size_option', $size->description)->first();

                    // Check if cart has the same selected product property or not
                    if(!empty($cart)){
                        $newQuantity = $cart->quantity + 1;+
                        $cart->quantity = $newQuantity;

                        // Check price
                        if(!empty($size->price)){
                            $cart->total_price = $newQuantity * $size->price;
                        }
                        else{
                            $cart->total_price = $newQuantity * $cart->product->getOriginal('price_discounted');
                        }

                        $cart->save();
                    }
                    else{
                        $cartCreate = Cart::Create([
                            'product_id'    => $productId,
                            'user_id'       => $userId,
                            'quantity'      => 1,
                            'size-option'   => $size->description
                        ]);

                        // Check price
                        if(!empty($size->price)){
                            $cartCreate->total_price = $size->price;
                        }
                        else{
                            $cartCreate->total_price = $cart->product->getOriginal('price_discounted');
                        }

                        $cartCreate->save();
                    }
                }
                elseif(!empty(Input::get('weight')) && Input::get('weight') != '0'){
                    $weight = $product->product_properties()->where('name', '=', 'weight')
                        ->where('description', Input::get('weight'))
                        ->first();
                    $cart = $cart->where('weight_option', $weight->description)->first();

                    // Check if cart has the same selected product property or not
                    if(!empty($cart)){
                        $newQuantity = $cart->quantity + 1;
                        $cart->quantity = $newQuantity;

                        // Check price
                        if(!empty($weight->price)){
                            $cart->total_price = $newQuantity * $weight->price;
                        }
                        else{
                            $cart->total_price = $newQuantity * $product->getOriginal('price_discounted');
                        }

                        if(!empty($note)) $cart->note = $note;

                        $cart->save();
                    }
                    else{
                        $cartCreate = Cart::Create([
                            'product_id'    => $productId,
                            'user_id'       => $userId,
                            'quantity'      => 1,
                            'weight-option' => $weight->description
                        ]);

                        // Check price
                        if(!empty($weight->price)){
                            $cartCreate->total_price = $weight->price;
                        }
                        else{
                            $cartCreate->total_price = $product->getOriginal('price_discounted');
                        }

                        if(!empty($note)) $cartCreate->note = $note;

                        $cartCreate->save();
                    }
                }
                else{
                    $cart = $cart->whereNull('weight_option')
                        ->whereNull('size_option')
                        ->first();

                    // Check if cart does not have any selected product property or not
                    if(!empty($cart)){
                        $newQuantity = $cart->quantity + 1;
                        $cart->quantity = $newQuantity;
                        $cart->total_price = $newQuantity * $product->getOriginal('price_discounted');

                        if(!empty($note)) $cart->note = $note;

                        $cart->save();
                    }
                    else{
                        $cartCreate = Cart::Create([
                            'product_id'    => $productId,
                            'user_id'       => $userId,
                            'quantity'      => 1,
                            'total_price'   => $product->getOriginal('price_discounted')
                        ]);

                        if(!empty($note)) {
                            $cartCreate->note = $note;
                            $cartCreate->save();
                        }
                    }
                }
            }
            else{
                $cart = Cart::Create([
                    'product_id' => $productId,
                    'user_id' => $userId,
                    'quantity' => 1,
                    'total_price' => $product->getOriginal('price_discounted')
                ]);

                if(!empty(Input::get('size')) && Input::get('size') != '0'){
                    $size = ProductProperty::where('name', '=', 'size')
                        ->where('description', Input::get('size'))
                        ->first();

                    $cart->size_option = Input::get('size');

                    if(!empty($size->price)){
                        $cart->total_price = $size->getOriginal('price');
                    }
                }
                elseif(!empty(Input::get('weight')) && Input::get('weight') != '0'){
                    $weight = ProductProperty::where('name', '=', 'size')
                        ->where('description', Input::get('weight'))
                        ->first();

                    $cart->weight_option = Input::get('weight');

                    if(!empty($weight->price)){
                        $cart->total_price = $weight->getOriginal('price');
                    }
                }

                if(!empty($note)) $cart->note = $note;

                $cart->save();
            }

            //edit session data
            $userId = Auth::user()->id;
            $carts = Cart::where('user_id', 'like', $userId)->get();
            $cartTotal = $carts->count();
            Session::put('cartList', $carts);
            Session::put('cartTotal', $cartTotal);

            return response()->json(['success' => true]);
        }
        catch (\Exception $ex){
            error_log($ex);
            return response()->json(['success' => false, 'error' => 'exception']);
        }
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

        $cart = Cart::find($cartId);

        //$price = $CartDB->getOriginal('total_price') / $CartDB->quantity;
        $price = $cart->product->getOriginal('price_discounted');
        $newSinglePrice = $quantity * $price;
        $newSinglePriceFormated = number_format($newSinglePrice, 0, ",", ".");

        $cart->quantity = $quantity;
        $cart->total_price = $newSinglePrice;
        $cart->save();

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