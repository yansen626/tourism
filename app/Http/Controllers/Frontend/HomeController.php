<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
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
        $topBanner1st = Banner::where('type', 1)->get();
        $topBanner2nd = Banner::where('type',2)->get();
        $categories = Category::orderBy('name')->get();
        $categoryTotal = $categories->count();

        if($categoryTotal % 2 == 1){
            $firstColumn = ($categoryTotal + 1) / 2;
        }
        else{
            $firstColumn = $categoryTotal / 2;
        }

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
            'topBanner1st'      => $topBanner1st,
            'topBanner2nd'      => $topBanner2nd,
            'userId'            => $userId,
            'categories'        => $categories,
            'categoryTotal'     => $categoryTotal,
            'firstColumn'       => $firstColumn
        ];

        return View('frontend.home')->with($data);
    }
}
