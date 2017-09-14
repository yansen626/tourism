<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
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
        $slideBanners = Banner::where('type', 1)->get();
        $banner1st = Banner::where('type',2)->get()->first();
        $banner2nd = Banner::where('type',3)->get()->first();
        $banner3rd = Banner::where('type',4)->get()->first();

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

        $data = [
            'recentProducts'    => $recentProducts,
            'featuredProducts'  => $featuredProducts,
            'slideBanners'      => $slideBanners,
            'userId'            => $userId,
            'banner1st'         => $banner1st,
            'banner2nd'         => $banner2nd,
            'banner3rd'         => $banner3rd
        ];

        return View('frontend.home')->with($data);
    }
}
