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

            if(!empty(Input::get('size'))){
                $size = ProductProperty::find(Input::get('size'));
                $note .= 'size='. $size->description;
            }

            $alreadyInCart = Cart::where([['user_id', '=', $userId], ['product_id', '=', $productId]])->first();
            if($alreadyInCart){
                $cart = Cart::where([['user_id', '=', $userId], ['product_id', '=', $productId]])->first();

                $newQuantity = $cart->quantity + 1;
                $cart->quantity = $newQuantity;
                $cart->total_price = $newQuantity * $cart->product->getOriginal('price_discounted');

                if(!empty($note)) $cart->note = $note;

                $cart->save();
            }
            else{
                $cart = Cart::Create([
                    'product_id' => $productId,
                    'user_id' => $userId,
                    'quantity' => 1,
                    'total_price' => $product->getOriginal('price_discounted')
                ]);

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