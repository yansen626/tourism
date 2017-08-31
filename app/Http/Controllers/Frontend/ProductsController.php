<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 8/31/2017
 * Time: 11:27 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    //
    public function ProductsShowAll(){
        return view('frontend.show-products');
    }

    //
    public function ProductShow(){
        return view('frontend.show-product');
    }
}
