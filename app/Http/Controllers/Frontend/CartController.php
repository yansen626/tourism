<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 9/5/2017
 * Time: 1:59 PM
 */

namespace App\Http\Controllers\Frontend;



use App\libs\Utilities;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ProductProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;

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

            // Get added qty
            $addedQty = intval(Input::get('cartQty'));

            $product = Product::find($productId);
//            if($product->quantity == 0){
//                return response()->json(['success' => false, 'error' => 'stock']);
//            }

            $note = "";
            if(!empty(Input::get('color'))){
                $color = ProductProperty::find(Input::get('color'));
                $note .= 'color='. $color->description. ';';
            }

            $carts = Cart::where([['user_id', '=', $userId], ['product_id', '=', $productId]])->get()->count();

            if($carts > 0){
                $cart = Cart::where('user_id', $userId)->where('product_id', $productId);
                $isExist = false;

                // Get size selection
                if(!empty(Input::get('size')) && Input::get('size') != '0'){
                    $size = $product->product_properties()->where('id', Input::get('size'))
                        ->first();
                    $cart = $cart->where('size_option', $size->description)->first();

                    // Check if cart has the same selected product property or not
                    if(!empty($cart)){
                        $newQuantity = $cart->quantity + $addedQty;+
                        $cart->quantity = $newQuantity;

                        // Check price
                        if(!empty($size->price)){
                            $cart->total_price = $newQuantity * $size->getOriginal('price');
                        }
                        else{
                            $cart->total_price = $newQuantity * $cart->product->getOriginal('price_discounted');
                        }

                        if(!empty(Input::get('buyerNote'))){
                            $cart->buyer_note = Input::get('buyerNote');
                        }

                        $cart->save();
                    }
                    else{
                        $cartCreate = Cart::Create([
                            'product_id'    => $productId,
                            'user_id'       => $userId,
                            'quantity'      => 1,
                            'size_option'   => $size->description
                        ]);

                        // Check price
                        if(!empty($size->price)){
                            $cartCreate->price = $size->getOriginal('price');
                            $cartCreate->total_price = $size->getOriginal('price');
                        }
                        else{
                            $cartCreate->price = $cart->product->getOriginal('price_discounted');
                            $cartCreate->total_price = $cart->product->getOriginal('price_discounted');
                        }

                        if(!empty(Input::get('buyerNote'))){
                            $cartCreate->buyer_note = Input::get('buyerNote');
                        }

                        $cartCreate->save();
                    }
                }
                // Get weight selection
                elseif(!empty(Input::get('weight')) && Input::get('weight') != '0'){
                    $weight = $product->product_properties()->where('id', Input::get('weight'))
                        ->first();
                    $cart = $cart->where('weight_option', $weight->description)->first();

                    // Check if cart has the same selected product property or not
                    if(!empty($cart)){
                        $newQuantity = $cart->quantity + $addedQty;
                        $cart->quantity = $newQuantity;

                        // Check price
                        if(!empty($weight->price)){
                            $cart->price = $weight->getOriginal('price');
                            $cart->total_price = $newQuantity * $weight->getOriginal('price');
                        }
                        else{
                            $cart->price = $product->getOriginal('price_discounted');
                            $cart->total_price = $newQuantity * $product->getOriginal('price_discounted');
                        }

                        if(!empty($note)) $cart->note = $note;
                        if(!empty(Input::get('buyerNote'))){
                            $cart->buyer_note = Input::get('buyerNote');
                        }

                        $cart->save();
                    }
                    else{
                        $cartCreate = Cart::Create([
                            'product_id'    => $productId,
                            'user_id'       => $userId,
                            'quantity'      => 1,
                            'weight_option' => $weight->description
                        ]);

                        // Check price
                        if(!empty($weight->price)){
                            $cartCreate->price = $weight->getOriginal('price');
                            $cartCreate->total_price = $weight->getOriginal('price');
                        }
                        else{
                            $cartCreate->price = $product->getOriginal('price_discounted');
                            $cartCreate->total_price = $product->getOriginal('price_discounted');
                        }

                        if(!empty($note)) $cartCreate->note = $note;
                        if(!empty(Input::get('buyerNote'))){
                            $cartCreate->buyer_note = Input::get('buyerNote');
                        }

                        $cartCreate->save();
                    }
                }
                // Get qty selection
                elseif(!empty(Input::get('qty')) && Input::get('qty') != '0'){
                    $qty = $product->product_properties()->where('id', Input::get('qty'))
                        ->first();
                    $cart = $cart->where('qty_option', $qty->description)->first();

                    // Check if cart has the same selected product property or not
                    if(!empty($cart)){
                        $newQuantity = $cart->quantity + $addedQty;
                        $cart->quantity = $newQuantity;

                        // Check price
                        if(!empty($qty->price)){
                            $cart->price = $qty->getOriginal('price');
                            $cart->total_price = $newQuantity * $qty->getOriginal('price');
                        }
                        else{
                            $cart->price = $product->getOriginal('price_discounted');
                            $cart->total_price = $newQuantity * $product->getOriginal('price_discounted');
                        }

                        if(!empty($note)) $cart->note = $note;
                        if(!empty(Input::get('buyerNote'))){
                            $cart->buyer_note = Input::get('buyerNote');
                        }

                        $cart->save();
                    }
                    else{
                        $cartCreate = Cart::Create([
                            'product_id'    => $productId,
                            'user_id'       => $userId,
                            'quantity'      => $addedQty,
                            'qty_option'    => $qty->description
                        ]);

                        // Check price
                        if(!empty($qty->price)){
                            $cartCreate->price = $qty->getOriginal('price');
                            $cartCreate->total_price = $qty->getOriginal('price');
                        }
                        else{
                            $cartCreate->price = $product->getOriginal('price_discounted');
                            $cartCreate->total_price = $product->getOriginal('price_discounted');
                        }

                        if(!empty($note)) $cartCreate->note = $note;
                        if(!empty(Input::get('buyerNote'))){
                            $cartCreate->buyer_note = Input::get('buyerNote');
                        }

                        $cartCreate->save();
                    }
                }
                else{
                    $cart = $cart->whereNull('weight_option')
                        ->whereNull('size_option')
                        ->whereNull('qty_option')
                        ->first();

                    // Check if cart does not have any selected product property or not
                    if(!empty($cart)){
                        $newQuantity = $cart->quantity + 1;
                        $cart->quantity = $newQuantity;
                        $cart->price = $product->getOriginal('price_discounted');
                        $cart->total_price = $newQuantity * $product->getOriginal('price_discounted');

                        if(!empty($note)) $cart->note = $note;

                        $cart->save();
                    }
                    else{
                        $cartCreate = Cart::Create([
                            'product_id'    => $productId,
                            'user_id'       => $userId,
                            'quantity'      => 1,
                            'price'         => $product->getOriginal('price_discounted'),
                            'total_price'   => $product->getOriginal('price_discounted')
                        ]);

                        if(!empty($note)) {
                            $cartCreate->note = $note;
                            $cartCreate->save();
                        }

                        if(!empty(Input::get('buyerNote'))){
                            $cartCreate->buyer_note = Input::get('buyerNote');
                            $cartCreate->save();
                        }
                    }
                }
            }
            else{
                $cart = Cart::Create([
                    'product_id'    => $productId,
                    'user_id'       => $userId,
                    'quantity'      => 1,
                    'price'         => $product->getOriginal('price_discounted'),
                    'total_price'   => $product->getOriginal('price_discounted')
                ]);

                error_log('size = '. Input::get('size'));
                error_log('weight = '. Input::get('weight'));

                if(!empty(Input::get('size')) && Input::get('size') != '0'){
                    $size = ProductProperty::find(Input::get('size'));

                    $cart->size_option = $size->description;

                    $cart->price = $size->getOriginal('price');
                    $cart->total_price = $size->getOriginal('price');
                }
                elseif(!empty(Input::get('weight')) && Input::get('weight') != '0'){
                    $weight = ProductProperty::find(Input::get('weight'));

                    $cart->weight_option = $weight->description;

                    $cart->price = $weight->getOriginal('price');
                    $cart->total_price = $weight->getOriginal('price');
                }
                elseif(!empty(Input::get('qty')) && Input::get('qty') != '0'){
                    $qty = ProductProperty::find(Input::get('qty'));

                    $cart->qty_option = $qty->description;

                    $cart->price = $qty->getOriginal('price');
                    $cart->total_price = $qty->getOriginal('price');
                }

                if(!empty($note)) $cart->note = $note;

                if(!empty(Input::get('buyerNote'))){
                    $cart->buyer_note = Input::get('buyerNote');
                }

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
            Utilities::ExceptionLog($ex);
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
        $price = 0;
        if(!empty($cart->size_option) && empty($cart->weight_option) && empty($cart->qty_option)){
            $size = $cart->product->product_properties()->where('name','=','size')
                ->where('description', $cart->size_option)
                ->first();

            if(empty($size)){
                return response()->json([
                    'success'       => false,
                    'exception'     => 'property'
                ]);
            }

            if(!empty($size->price)){
                $price = $size->getOriginal('price');
            }
            else{
                $price = $cart->product->getOriginal('price_discounted');
            }
        }
        elseif(empty($cart->size_option) && !empty($cart->weight_option) && empty($cart->qty_option)){
            $weight = $cart->product->product_properties()->where('name','=','weight')
                ->where('description', $cart->weight_option)
                ->first();

            if(empty($weight)){
                return response()->json([
                    'success'       => false,
                    'exception'     => 'property'
                ]);
            }

            if(!empty($weight->price)){
                $price = $weight->getOriginal('price');
            }
        }
        elseif(empty($cart->size_option) && empty($cart->weight_option) && !empty($cart->qty_option)){
            $qty = $cart->product->product_properties()->where('name','=','qty')
                ->where('description', $cart->qty_option)
                ->first();

            if(empty($qty)){
                return response()->json([
                    'success'       => false,
                    'exception'     => 'property'
                ]);
            }

            if(!empty($qty->price)){
                $price = $qty->getOriginal('price');
            }
        }
        else{
            $price = $cart->product->getOriginal('price_discounted');
        }

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
            'success'       => true,
            'totalPrice'    => $newTotalPriceFormated,
            'singlePrice'   => $newSinglePriceFormated
        ]);
//        return ['totalPrice' => $newTotalPriceFormated,'singlePrice' => $newSinglePriceFormated];
    }

    public function getNotes($id){
        $cart = Cart::find($id);

        $notes = "default";
        if(!empty($cart->buyer_note)) $notes = $cart->buyer_note;

        return response()->json([
            'success'   => true,
            'notes'     => $notes
        ]);
    }

    public function checkNoteForCartAdd(Request $request){

        error_log('CHECK!');

        $user = Auth::user();
        $userId = $user->id;

        $product = Product::find(Input::get('product_id'));

        $notes = "default";

        $note = "";
        if(!empty(Input::get('color'))){
            $color = ProductProperty::find(Input::get('color'));
            $note .= 'color='. $color->description. ';';
        }

        $carts = Cart::where([['user_id', '=', $userId], ['product_id', '=', $product->id]])->get()->count();

        if($carts > 0){
            $cart = Cart::where('user_id', $userId)->where('product_id', $product->id);
            $isExist = false;

            // Get size selection
            if(!empty(Input::get('size')) && Input::get('size') != '0'){
                $size = $product->product_properties()->where('id', Input::get('size'))
                    ->first();
                $cart = $cart->where('size_option', $size->description)->first();

                // Check if cart has the same selected product property or not
                if(!empty($cart)){
                    $notes = $cart->buyer_note;
                }
            }
            // Get weight selection
            elseif(!empty(Input::get('weight')) && Input::get('weight') != '0'){
                $weight = $product->product_properties()->where('id', Input::get('weight'))
                    ->first();
                $cart = $cart->where('weight_option', $weight->description)->first();

                // Check if cart has the same selected product property or not
                if(!empty($cart)){
                    $notes = $cart->buyer_note;
                }
            }
            // Get qty selection
            elseif(!empty(Input::get('qty')) && Input::get('qty') != '0'){
                $qty = $product->product_properties()->where('id', Input::get('qty'))
                    ->first();
                $cart = $cart->where('qty_option', $qty->description)->first();

                // Check if cart has the same selected product property or not
                if(!empty($cart)){
                    $notes = $cart->buyer_note;
                }
            }
            else{
                $cart = $cart->whereNull('weight_option')
                    ->whereNull('size_option')
                    ->whereNull('qty_option')
                    ->first();

                // Check if cart does not have any selected product property or not
                if(!empty($cart)){
                    $notes = $cart->buyer_note;
                }
            }
        }

        return response()->json([
            'success'   => true,
            'notes'     => $notes
        ]);
    }

    public function storeNotes(Request $request){
        $cart = Cart::find(Input::get('cart_id'));
        $cart->buyer_note = Input::get('buyer_note');
        $cart->save();

        return redirect()->route('cart-list');
    }
}