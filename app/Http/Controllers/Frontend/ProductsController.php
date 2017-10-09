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
    public function products($categoryId, $categoryName){

        $products = Product::where('status_id', '=', 1);

        if($categoryId > 0){
            $products = $products->where([['category_id', '=', $categoryId], ['status_id', '=', 1], ['quantity', '>', 0]]);
            $selectedCategory = Category::find($categoryId);
        }
        else
        {
            $selectedCategory = new Category([
                'id' => 0,
                'name' => 'All'
            ]);
        }

        if(!empty(request()->max) && !empty(request()->min)){
            $products = $products->whereBetween('price_discounted', [floatval(request()->min), floatval(request()->max)]);
        }
        else if(!empty(request()->max && empty(request()->min))){
            $products = $products->where('price_discounted', '<=', floatval(request()->max));
        }
        else if(empty(request()->max && !empty(request()->min))){
            $products = $products->where('price_discounted', '>=', floatval(request()->min));
        }

        if(!empty(request()->sort)){
            $sort = request()->sort;
            if($sort == '1'){
                // Newest
                $products->orderByDesc('created_on');
            }
            else if($sort == '2'){
                // Lowest-Highest Price
                $products->orderBy('price_discounted');
            }
            else if($sort == '3'){
                // Highest-Lowest Price
                $products->orderByDesc('price_discounted');
            }
            else if($sort == '4'){
                // A-Z
                $products->orderBy('name');
            }
        }
        else{
            $products->orderByDesc('created_on');
        }

        $productCount = $products->count();
        $products = $products->paginate(9);

        $categories = Category::all();

        $data = [
            'products'          => $products,
            'productCount'      => $productCount,
            'categories'        => $categories,
            'selectedCategory'  => $selectedCategory,
            'filterMaxPrice'    => request()->max ?? null,
            'filterMinPrice'    => request()->min ?? null,
            'filterSort'        => request()->sort ?? null
        ];

        return View('frontend.show-products')->with($data);
    }

    //
    public function ProductShow($id){
        $product = Product::find($id);
        $photos = $product->product_image()->where('featured',0)->get();
        $recommendedProducts = Product::where('category_id', '=', $product->category_id)
            ->where('status_id',1)
            ->inRandomOrder()
            ->take(6)
            ->get();

        $colors = $product->product_properties()->where('name','color')->get();
        $sizes = $product->product_properties()->where('name','size')->get();

        $data =[
            'product'               => $product,
            'photos'                => $photos,
            'recommendedProducts'   => $recommendedProducts,
            'colors'                => $colors,
            'sizes'                 => $sizes
        ];

        return View('frontend.show-product')->with($data);
    }

    public function search($key){

        $products = Product::where('status_id', '=', 1)
            ->where('name','LIKE','%'. $key. '%');

        if(!empty(request()->category) && request()->category != '-1'){
            $products = $products->where('category_id', intval(request()->category));
        }

        if(!empty(request()->max) && !empty(request()->min)){
            $products = $products->whereBetween('price_discounted', [floatval(request()->min), floatval(request()->max)]);
        }
        else if(!empty(request()->max && empty(request()->min))){
            $products = $products->where('price_discounted', '<=', floatval(request()->max));
        }
        else if(empty(request()->max && !empty(request()->min))){
            $products = $products->where('price_discounted', '>=', floatval(request()->min));
        }

        if(!empty(request()->sort)){
            $sort = request()->sort;
            if($sort == '1'){
                // Newest
                $products->orderByDesc('created_on');
            }
            else if($sort == '2'){
                // Lowest-Highest Price
                $products->orderBy('price_discounted');
            }
            else if($sort == '3'){
                // Highest-Lowest Price
                $products->orderByDesc('price_discounted');
            }
            else if($sort == '4'){
                // A-Z
                $products->orderBy('name');
            }
        }

        $productCount = $products->count();

        $products = $products->paginate(9);
        $categories = Category::all();
        $selectedCategory = new Category([
            'id' => 0,
            'name' => 'All'
        ]);

        if(!empty(request()->category) && request()->category != '-1'){
            $selectedCategory = Category::find(request()->category);
        }

        $data = [
            'products'          => $products,
            'productCount'      => $productCount,
            'categories'        => $categories,
            'selectedCategory'  => $selectedCategory,
            'filterCategory'    => request()->category ?? null,
            'filterMaxPrice'    => request()->max ?? null,
            'filterMinPrice'    => request()->min ?? null,
            'filterSort'        => request()->sort ?? null,
            'searchKey'         => $key
        ];

        return View('frontend.show-search-results')->with($data);
    }
}
