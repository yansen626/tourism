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
        $product = Product::find($id);
        $photos = $product->product_image()->where('featured',0)->get();
        $recommendedProducts = Product::where('category_id', '=', $product->category_id)->inRandomOrder()->take(6)->get();

        $data =[
            'product'               => $product,
            'photos'                => $photos,
            'recommendedProducts'   => $recommendedProducts
        ];

        return View('frontend.show-product')->with($data);
    }

    public function search($key){
        $products = Product::where('status_id', '=', 1)
            ->where('name','LIKE','%'. $key. '%')
            ->paginate(9);
        $productCount = Product::where('status_id', '=', 1)->count();
        $categories = Category::all();
        $selectedCategory = new Category([
            'id' => 0,
            'name' => 'All Category'
        ]);

        $data = [
            'products'          => $products,
            'productCount'      => $productCount,
            'categories'        => $categories,
            'selectedCategory'  => $selectedCategory
        ];

        return View('frontend.show-search-results')->with($data);
    }
}
