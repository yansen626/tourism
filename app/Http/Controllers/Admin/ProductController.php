<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 30/08/2017
 * Time: 12:01
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();

        return View('admin.show-products', compact('products'));
    }

    public function createShow(){
        $categories = Category::all();

        return View('admin.create-product', compact('categories'));
    }

    public function createSubmit(Request $request){

        $validator = Validator::make($request->all(),[
            'category'              => 'required|option_not_default',
            'name'                  => 'required',
            'price'                 => 'required',
            'weight'                => 'required',
            'product-featured'      => 'image|mimes:jpeg,jpg,png'
        ],[
            'option_not_default'    => 'Select a category'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        else{
            $price = $request->input('price');
            $priceDouble = (double) str_replace('.','', $price);
            $weight = (double) str_replace('.','', Input::get('weight'));

            $dateTimeNow = Carbon::now('Asia/Jakarta');

            $product = Product::create([
                'id'            => Uuid::generate(),
                'category_id'   => Input::get('category'),
                'name'          => Input::get('name'),
                'price'         => $priceDouble,
                'weight'        => $weight,
                'created_on'    => $dateTimeNow->toDateTimeString(),
                'status_id'     => 1
            ]);

            if(Input::get('options') == 'percent'){
                $discountPercent = (double) Input::get('discount-percent');
                $product->discount = $discountPercent;

                $discountAmount = $priceDouble / 100 * $discountPercent;
                $product->price_discounted = $priceDouble - $discountAmount;
            }
            else if(Input::get('options') == 'flat'){
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

                // Get image extension
                $extStr = $img->mime();
                $ext = explode('/', $extStr, 2);

                $filename = $savedId.'_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '_0.'. $ext[1];

                $img->save(public_path('storage\product' . '\\'. $filename));

                $productImgFeatured = ProductImage::create([
                    'product_id'    => $savedId,
                    'path'          => $filename,
                    'featured'      => 1
                ]);

                $productImgFeatured->save();
            }

            if(!empty($request->file('product-photos'))){
                $idx = 1;
                foreach($request->file('product-photos') as $img){
                    error_log('index: '. $idx);
                    $photo = Image::make($img);

                    // Get image extension
                    $extStr = $photo->mime();
                    $ext = explode('/', $extStr, 2);

                    $filename = $savedId.'_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '_'. $idx. '.'. $ext[1];


                    $photo->save(public_path('storage\product'. '\\'. $filename));

                    $productPhoto = ProductImage::create([
                        'product_id'    => $savedId,
                        'path'          => $filename,
                        'featured'      => 0
                    ]);

                    $productPhoto->save();
                    $idx++;
                }
            }
            return redirect::route('product-list-view');
        }
    }
}