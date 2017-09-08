<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function Home(Request $request){
        $recentProducts = Product::orderby('created_on', 'desc')->take(10)->get();
        $featuredProducts = Product::inRandomOrder()->take(6)->get();

        if (Auth::check())
        {
            $userId = Auth::user()->id;

            $carts = Cart::where('user_id', 'like', $userId)->get();
            $cartTotal = $carts->count();

            Session::put('cartList', $carts);
            Session::put('cartTotal', $cartTotal);
        }
        else
        {
            $userId = null;
        }
        $request->session()->put('key', 'value');

        return view('frontend.home',compact('recentProducts', 'featuredProducts', 'userId'));
    }
}
