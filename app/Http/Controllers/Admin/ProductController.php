<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 30/08/2017
 * Time: 12:01
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        return View('admin.show-products', compact('products'));
    }

    public function create(Request $request){
        if(!empty($request->file('product-featured'))){
            $img = Image::make($request->file('product-featured'));
            $img->save(public_path('storage\product\test.png'));


            echo "success";
        }else{
            echo "failed";
        }
    }
}