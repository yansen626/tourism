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
        $sliderBanners = Banner::where('type', 1)->get();
        $banner1st = Banner::where('type',2)->first();
        $banner2nd = Banner::where('type',3)->first();
        $banner3rd = Banner::where('type',4)->first();
        $banner4th = Banner::where('type',5)->first();
        $categories = Category::orderBy('name')->get();
        $categoryTotal = $categories->count();

        $cat1Products = Product::where('category_id',3)
            ->inRandomOrder()->take(4)->get();
        $cat2Products = Product::where('category_id',8)
            ->inRandomOrder()->take(4)->get();
        $cat3Products = Product::where('category_id',13)
            ->inRandomOrder()->take(4)->get();
        $cat4Products = Product::where('category_id',4)
            ->inRandomOrder()->take(4)->get();
        $cat5Products = Product::where('category_id',1)
            ->inRandomOrder()->take(4)->get();
        $cat6Products = Product::where('category_id',19)
            ->inRandomOrder()->take(4)->get();
        $cat7Products = Product::where('category_id',23)
            ->inRandomOrder()->take(4)->get();
        $cat8Products = Product::where('category_id',12)
            ->inRandomOrder()->take(4)->get();
        $cat9Products = Product::where('category_id',25)
            ->inRandomOrder()->take(4)->get();

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
            'sliderBanners'     => $sliderBanners,
            'banner1st'         => $banner1st,
            'banner2nd'         => $banner2nd,
            'banner3rd'         => $banner3rd,
            'banner4th'         => $banner4th,
            'userId'            => $userId,
            'categories'        => $categories,
            'categoryTotal'     => $categoryTotal,
            'firstColumn'       => $firstColumn,
            'cat1Products'      => $cat1Products
        ];

        return View('frontend.home')->with($data);
    }
}
