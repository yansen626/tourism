<?php
/**
 * Created by PhpStorm.
 * User: yanse
 * Date: 8/31/2017
 * Time: 11:27 AM
 */

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class ProductsController extends Controller
{
    //
    public function ProductsShowAll($categoryId){
        //$products = Product::all();
        if($categoryId > 0){
            $products = Product::where([['category_id', '=', $categoryId], ['status_id', '=', 1]])->paginate(9);
            $productCount = Product::where([['category_id', '=', $categoryId], ['status_id', '=', 1]])->count();
            $categories = Category::all();
            $selectedCategory = Category::find($categoryId);
        }
        else{
            $products = Product::where('status_id', '=', 1)->paginate(9);
            $productCount = Product::where('status_id', '=', 1)->count();
            $categories = Category::all();
            $selectedCategory = new Category([
                'id' => 0,
                'name' => 'All Category'
            ]);
        }
        return View('frontend.show-products', compact('products', 'selectedCategory', 'categories', 'productCount'));
    }

    //
    public function ProductShow($id){
        $singleProduct = Product::find($id);
        $recentProducts = Product::orderby('created_on', 'desc')->take(10)->get();
        $recommendedProducts = Product::where('category_id', '=', $singleProduct->category_id)->inRandomOrder()->take(6)->get();

        return view('frontend.show-product', compact('singleProduct', 'recentProducts', 'recommendedProducts') );
    }
}
