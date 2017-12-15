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

//        $recentProducts = Product::where('status_id', 1)
//            ->where('quantity','>',0)
//            ->orderByDesc('created_on')
//            ->take(10)
//            ->get();

        $recentProducts = Product::where('status_id', 1)
            ->orderByDesc('created_on')
            ->take(10)
            ->get();

        $sliderBanners = Banner::where('type', 1)
            ->where('status_id', 1)
            ->get();
        $banner1st = Banner::where('type',2)->where('status_id', 1)->first();

        if(!empty($banner1st->gallery_id) && $banner1st->gallery->status_id == 2){
            $banner1st = null;
        }

        $banner2nd = Banner::where('type',3)->where('status_id', 1)->first();

        if(!empty($banner2nd->gallery_id) && $banner2nd->gallery->status_id == 2){
            $banner2nd = null;
        }

        $banner3rd = Banner::where('type',4)->where('status_id', 1)->first();

        if(!empty($banner3rd->gallery_id) && $banner3rd->gallery->status_id == 2){
            $banner3rd = null;
        }

        $banner4th = Banner::where('type',5)->where('status_id', 1)->first();

        if(!empty($banner4th->gallery_id) && $banner4th->gallery->status_id == 2){
            $banner4th = null;
        }

        $categories = Category::orderBy('name')->get();
        $categoryTotal = $categories->count();

        $cat1Products = Product::where('category_id',3)
            ->where('status_id', 1)
            ->inRandomOrder()->take(4)->get();
        $cat2Products = Product::where('category_id',8)
            ->where('status_id', 1)
            ->inRandomOrder()->take(4)->get();
        $cat3Products = Product::where('category_id',13)
            ->where('status_id', 1)
            ->inRandomOrder()->take(4)->get();
        $cat4Products = Product::where('category_id',4)
            ->where('status_id', 1)
            ->inRandomOrder()->take(4)->get();
        $cat5Products = Product::where('category_id',1)
            ->where('status_id', 1)
            ->inRandomOrder()->take(4)->get();
        $cat6Products = Product::where('category_id',19)
            ->where('status_id', 1)
            ->inRandomOrder()->take(4)->get();
        $cat7Products = Product::where('category_id',23)
            ->where('status_id', 1)
            ->inRandomOrder()->take(4)->get();
        $cat8Products = Product::where('category_id',12)
            ->where('status_id', 1)
            ->inRandomOrder()->take(4)->get();
        $cat9Products = Product::where('category_id',25)
            ->where('status_id', 1)
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
            'sliderBanners'     => $sliderBanners,
            'banner1st'         => $banner1st,
            'banner2nd'         => $banner2nd,
            'banner3rd'         => $banner3rd,
            'banner4th'         => $banner4th,
            'userId'            => $userId,
            'categories'        => $categories,
            'categoryTotal'     => $categoryTotal,
            'firstColumn'       => $firstColumn,
            'cat1Products'      => $cat1Products,
            'cat2Products'      => $cat2Products,
            'cat3Products'      => $cat3Products,
            'cat4Products'      => $cat4Products,
            'cat5Products'      => $cat5Products,
            'cat6Products'      => $cat6Products,
            'cat7Products'      => $cat7Products,
            'cat8Products'      => $cat8Products,
            'cat9Products'      => $cat9Products
        ];

        return View('frontend.home')->with($data);
    }

    public function terms(){
        return View('frontend.terms');
    }
}
