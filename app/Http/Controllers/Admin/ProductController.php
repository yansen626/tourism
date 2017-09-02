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
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        return View('admin.show-products', compact('products'));
    }

    public function create(Request $request){

        $price = $request->input('price');
        $priceDouble = (double) str_replace('.','', $price);

        $dateTimeNow = Carbon::now();

        $product = Product::create([
            'name'          => $request->input('name'),
            'price'         => $priceDouble,
            'weight'        => $request->input('weight'),
            'created_on'    => $dateTimeNow->toDateTimeString()
        ]);

        if(Input::get('options') == 'percent'){
            $discountPercent = (double) Input::get('discount-percent');
            $product->discount = $discountPercent;

            $discountAmount = $price / 100 * $discountPercent;
            $product->price_discounted = $priceDouble - $discountAmount;
        }
        else if(Input::get('options') == flat){
            $discountFlat = (double) str_replace('.','', Input::get('discount-flat'));
            $product->discount_flat = $discountFlat;

            $product->price_discounted = $priceDouble - $discountFlat;
        }

        if(!empty(Input::get('description'))){
            $product->description = Input::get('description');
        }

        $product->save();
        $savedId = $product->id;

        if(!empty($request->file('product-featured'))){
            $img = Image::make($request->file('product-featured'));

            $filename = $savedId.'_'. Carbon::now()->format('Ymdhms'). '_0';

            $img->save(public_path('storage\product\'' . $filename));

            $productImgFeatured = ProductImage::create([
                'product_id'    => $savedId,
                'path'          => $$filename,
                'featured'      => 1
            ]);

            $productImgFeatured->save();
        }

        if(!empty($request->file('product-photos'))){
            $images = Input::get('product-photos');
            $idx = 1;
            foreach( $images as $img){
                $photo = Image::make($img);

                $filename = $savedId.'_'. Carbon::now()->format('Ymdhms'). '_'. $idx;

                $img->save(public_path('storage\product\'' . $filename));

                $productPhoto = ProductImage::create([
                    'product_id'    => $savedId,
                    'path'          => $$filename,
                    'featured'      => 0
                ]);

                $productPhoto->save();
            }
        }
    }
}