<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 30/08/2017
 * Time: 12:01
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\libs\Utilities;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductProperty;
use App\Models\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function index(){
        $products = null;

        if(!empty(request()->category) && !empty(request()->status)){
            $products = Product::where('category_id', request()->category)
                ->where('status_id', request()->status)
                ->orderByDesc('created_on')
                ->get();
        }
        else if(!empty(request()->category) && empty(request()->status)){
            $products = Product::where('category_id', request()->category)
                ->orderByDesc('created_on')
                ->get();
        }
        else if(empty(request()->category) && !empty(request()->status)){
            $products = Product::where('status_id', intval(request()->status))
                ->orderByDesc('created_on')
                ->get();
        }
        else if(empty(request()->category && empty(request()->status))){
            $products = Product::all()->sortByDesc('created_on');
        }

        // Get all categories
        $categories = Category::all();

        $data = [
            'products'          => $products,
            'categories'        => $categories,
            'filterCategory'    => request()->category ?? null,
            'filterStatus'      => request()->status ?? null,
        ];

        return View('admin.show-products')->with($data);
    }

    public function create(){
        $categories = Category::all();

        return View('admin.create-product', compact('categories'));
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'category'              => 'required|option_not_default',
                'name'                  => 'required',
                'product-featured'      => 'required|image|mimes:jpeg,jpg,png'
            ],[
                'option_not_default'    => 'Select a category'
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Validation of no options selected
            if((Input::get('size-options') == 'no') && Input::get('weight-options') == 'no' && Input::get('qty-options') == 'no'){
                $validator = Validator::make($request->all(),[
                    'price'     => 'required',
                    'weight'    => 'required'
                ]);

                if ($validator->fails()) {
                    return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
                }
            }
            // Validation of size options
            else if((Input::get('size-options') == 'yes') && Input::get('weight-options') == 'no' && Input::get('qty-options') == 'no'){
                $validator = Validator::make($request->all(),[
                    'weight'    => 'required'
                ]);

                if ($validator->fails()) {
                    return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
                }

                // Validate size option array
                $isValid = true;
                $sizes = Input::get('size');
                $sizePrice = Input::get('size-price');
                $sizeWeight = Input::get('size-weight');
                if(!empty($sizes)){
                    $idx = 0;
                    foreach($sizes as $size){
                        if($idx != count($sizes) - 1){
                            if(empty($size)) $isValid = false;
                            if(empty($sizePrice[$idx])) $isValid = false;
                            if(empty($sizeWeight[$idx])) $isValid = false;
                        }
                        $idx++;
                    }
                }
                else{
                    $isValid = false;
                }

                if(!$isValid){
                    return redirect()->back()->withErrors('Size property is required!', 'default')->withInput($request->all());
                }
            }
            // Validation of weight options
            else if(Input::get('size-options') == 'no' && Input::get('weight-options') == 'yes' && Input::get('qty-options') == 'no'){

                // Validate weight option array
                $isValid = true;
                $weights = Input::get('weight');
                $weightPrice = Input::get('weight-price');
                if(!empty($weights)){
                    $idx = 0;
                    foreach($weights as $weight){
                        if($idx != count($weights) - 1){
                            if(empty($weight)) $isValid = false;
                            if(empty($weightPrice[$idx])) $isValid = false;
                        }
                        $idx++;
                    }
                }
                else{
                    $isValid = false;
                }

                if(!$isValid){
                    return redirect()->back()->withErrors('Weight property is required!', 'default')->withInput($request->all());
                }
            }
            // Validation of qty options
            else if(Input::get('size-options') == 'no' && Input::get('weight-options') == 'no' && Input::get('qty-options') == 'yes'){

                // Validate qty option array
                $isValid = true;
                $qtys = Input::get('qty');
                $qtyPrice = Input::get('qty-price');
                $qtyWeight = Input::get('qty-weight');
                if(!empty($qtys)){
                    $idx = 0;
                    foreach($qtys as $qty){
                        if($idx != count($qtys) - 1){
                            if(empty($qty)) $isValid = false;
                            if(empty($qtyPrice[$idx])) $isValid = false;
                            if(empty($qtyWeight[$idx])) $isValid = false;
                        }
                        $idx++;
                    }
                }
                else{
                    $isValid = false;
                }

                if(!$isValid){
                    return redirect()->back()->withErrors('Quantity property is required!', 'default')->withInput($request->all());
                }
            }

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            else{
                $price = $request->input('price');
                $priceDouble = (double) str_replace('.','', $price);
                $weightStr = str_replace('.','', Input::get('weight-primary'));
                $weight = floatval($weightStr);


                $dateTimeNow = Carbon::now('Asia/Jakarta');

                $product = Product::create([
                    'id'            => Uuid::generate(),
                    'category_id'   => Input::get('category'),
                    'name'          => Input::get('name'),
                    'price'         => $priceDouble,
                    'weight'        => $weight,
                    'quantity'      => 0,
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
                else{
                    $product->price_discounted = $priceDouble;
                }

                if(!empty(Input::get('description'))){
                    $product->description = Input::get('description');
                }

                $product->save();
                $savedId = $product->id;

                // Check color & size
                if(Input::get('color-options') == 'yes'){
                    $idx = 0;
                    foreach(Input::get('color') as $color){
                        if(!empty($color)){
                            $propertyColor = ProductProperty::create([
                                'product_id'    => $savedId,
                                'name'          => 'color',
                                'description'   => $color
                            ]);

                            if($idx == 0){
                                $propertyColor->primary = 1;
                            }
                            else{
                                $propertyColor->primary = 0;
                            }

                            $propertyColor->save();
                        }
                        $idx++;
                    }
                }

                if(Input::get('size-options') == 'yes'){
                    $idx = 0;
                    $sizePrice = Input::get('size-price');
                    $sizeWeight = Input::get('size-weight');
                    foreach(Input::get('size') as $size){
                        if(!empty($size)){
                            $propertySize = ProductProperty::create([
                                'product_id'    => $savedId,
                                'name'          => 'size',
                                'description'   => $size
                            ]);

                            // Set Size Price
                            $propertySize->price = $sizePrice[$idx];

                            // Set Size Weight
                            $propertySize->weight = $sizeWeight[$idx];

                            if($idx == 0){
                                $product->price = $sizePrice[$idx];
                                $product->price_discounted = $sizePrice[$idx];
                                $product->weight = $sizeWeight[$idx];
                                $product->save();

                                $propertySize->primary = 1;
                            }
                            else{
                                $propertySize->primary = 0;
                            }

                            $propertySize->save();
                        }
                        $idx++;
                    }
                }

                if(Input::get('weight-options') == 'yes'){
                    $idx = 0;
                    $weightPrice = Input::get('weight-price');
                    foreach(Input::get('weight') as $weightOpt){
                        if(!empty($weightOpt)){
                            $propertyWeight = ProductProperty::create([
                                'product_id'    => $savedId,
                                'name'          => 'weight',
                                'description'   => $weightOpt
                            ]);

                            if(!empty($weightPrice[$idx])){
//                                $propertyPriceDouble = (double) str_replace('.','', $weightPrice[$idx]);
                                $propertyWeight->price = $weightPrice[$idx];


                                if($idx == 0){
                                    $product->price = $weightPrice[$idx];
                                    $product->price_discounted = $weightPrice[$idx];
                                    $product->save();
                                }
                            }

                            if($idx == 0){
                                $propertyWeight->primary = 1;
                                $product->weight = $weightOpt;
                                $product->save();
                            }
                            else{
                                $propertyWeight->primary = 0;
                            }

                            $propertyWeight->save();
                        }

                        error_log('index = '. $idx);

                        $idx++;
                    }
                }

                if(Input::get('qty-options') == 'yes'){
                    $idx = 0;
                    $qtyPrice = Input::get('qty-price');
                    $qtyWeight = Input::get('qty-weight');
                    foreach(Input::get('qty') as $qty){
                        if(!empty($qty)){
                            $propertyQty = ProductProperty::create([
                                'product_id'    => $savedId,
                                'name'          => 'qty',
                                'description'   => $qty
                            ]);

                            if(!empty($qtyPrice[$idx])){
                                $propertyQty->price = $qtyPrice[$idx];


                                if($idx == 0){
                                    $product->price = $qtyPrice[$idx];
                                    $product->price_discounted = $qtyPrice[$idx];
                                    $product->save();
                                }
                            }

                            if(!empty($qtyWeight[$idx])){
                                $propertyQty->weight = $qtyWeight[$idx];
                                $product->weight = $qtyWeight[$idx];
                                $product->save();
                            }

                            if($idx == 0){
                                $propertyQty->primary = 1;
                            }
                            else{
                                $propertyQty->primary = 0;
                            }

                            $propertyQty->save();
                        }
                        $idx++;
                    }
                }

                if(!empty($request->file('product-featured'))){
                    $img = Image::make($request->file('product-featured'));

                    // Get image extension
                    $extStr = $img->mime();
                    $ext = explode('/', $extStr, 2);

                    $filename = $savedId.'_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '_0.'. $ext[1];

                    $img->save(public_path('storage/product/'. $filename), 75);

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


                        $photo->save(public_path('storage/product/'. $filename), 60);

                        $productPhoto = ProductImage::create([
                            'product_id'    => $savedId,
                            'path'          => $filename,
                            'featured'      => 0
                        ]);

                        $productPhoto->save();
                        $idx++;
                    }
                }

                Session::flash('message', 'New product '. $product->name. ' has been successfully created!');

                return redirect::route('product-list');
            }
        }
        catch(\Exception $ex){
            Utilities::ExceptionLog($ex);
        }
    }

    public function edit($id){
        $product = Product::findorFail($id);

        $imgFeatured = null;
        if($product->product_image->count() > 0){
            $imgFeatured = $product->product_image()->where('featured', 1)->first()->path;
        }
        $imgPhotos = $product->product_image()->where('featured', 0)->get();
        $categories = Category::all();

        // Get product properties
        $weightProperties = ProductProperty::where('product_id', $id)
            ->where('name', '=', 'weight')
            ->get();

        $sizeProperties = ProductProperty::where('product_id', $id)
            ->where('name', '=', 'size')
            ->get();

        $qtyProperties = ProductProperty::where('product_id', $id)
            ->where('name', '=', 'qty')
            ->get();


        $data = [
            'product'           => $product,
            'imgFeatured'       => $imgFeatured,
            'imgPhotos'         => $imgPhotos,
            'categories'        => $categories,
            'weightProperties'  => $weightProperties,
            'sizeProperties'    => $sizeProperties,
            'qtyProperties'     => $qtyProperties
        ];

        return view('admin.edit-product')->with($data);
    }

    public function update(Request $request, $id){
        try{
            $product = Product::find($id);

            // Check delete
            if(Input::get('status') == '2'){
                $oldName = $product->name;

                // Check transaction
                $trxDetails = TransactionDetail::where('product_id', $id)->get();
                if($trxDetails->count() > 0){
                    return redirect()
                        ->back()
                        ->withErrors("Product cannot be deleted")
                        ->withInput();
                }

                // Check cart
                $carts = Cart::where('product_id', $id)->get();

                if($carts->count() > 0){
                    foreach($carts as $cart){
                        $cart->delete();
                    }
                }

                $images = ProductImage::where('product_id', $id)->get();

                if($images->count() > 0){
                    foreach($images as $img){
                        $deletedPath = storage_path('app/public/product/'. $img->path);
                        if(file_exists($deletedPath)) unlink($deletedPath);

                        $img->delete();
                    }
                }

                $properties = ProductProperty::where('product_id', $id)->get();

                if($properties->count() > 0){
                    foreach($properties as $property){
                        $property->delete();
                    }
                }

                $product->delete();

                Session::flash('message', 'Product '. $oldName. ' has been deleted!');

                return redirect::route('product-list');
            }

            if($product->product_properties()->where('name', '=', 'size')->count() > 0 &&
                $product->product_properties()->where('name', '=', 'weight')->count() == 0 &&
                $product->product_properties()->where('name', '=', 'qty')->count() == 0){

                $validator = Validator::make($request->all(),[
                    'category'              => 'required|option_not_default',
                    'name'                  => 'required'
                ],[
                    'option_not_default'    => 'Select a category'
                ]);
            }
            else if($product->product_properties()->where('name', '=', 'size')->count() == 0 &&
                $product->product_properties()->where('name', '=', 'weight')->count() > 0 &&
                $product->product_properties()->where('name', '=', 'qty')->count() == 0){

                $validator = Validator::make($request->all(),[
                    'category'              => 'required|option_not_default',
                    'name'                  => 'required'
                ],[
                    'option_not_default'    => 'Select a category'
                ]);
            }
            else if($product->product_properties()->where('name', '=', 'size')->count() == 0 &&
                $product->product_properties()->where('name', '=', 'weight')->count() == 0 &&
                $product->product_properties()->where('name', '=', 'qty')->count() > 0){

                $validator = Validator::make($request->all(),[
                    'category'              => 'required|option_not_default',
                    'name'                  => 'required'
                ],[
                    'option_not_default'    => 'Select a category'
                ]);
            }
            else{
                $validator = Validator::make($request->all(),[
                    'category'              => 'required|option_not_default',
                    'name'                  => 'required',
                    'price'                 => 'required',
                    'weight'                => 'required',
                ],[
                    'option_not_default'    => 'Select a category'
                ]);
            }


            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }
            else{

                $product->name = Input::get('name');
                $product->category_id = Input::get('category');

                $status = Input::get('status');
                $product->status_id = $status === '1' ? 1 : 2;

                // Check description
                if(!empty(Input::get('description'))){
                    $product->description = Input::get('description');
                }
                else{
                    $product->description = null;
                }

                // Check property
                $sizeProperties = $product->product_properties()->where('name', '=', 'size')->get();
                $weightProperties = $product->product_properties()->where('name', '=', 'weight')->get();

                $price = $request->input('price');
                $priceDouble = (double) str_replace('.','', $price);
                $weight = (double) str_replace('.','', Input::get('weight'));

                if($sizeProperties->count() == 0 && $weightProperties->count() == 0){
                    $product->price = $priceDouble;
//                  $product->weight = $weight;
//                  $product->quantity = Input::get('qty');

                    if(Input::get('options') == 'percent'){
                        $discountPercent = (double) Input::get('discount-percent');
                        $product->discount = $discountPercent;

                        $discountAmount = $priceDouble / 100 * $discountPercent;
                        $product->price_discounted = $priceDouble - $discountAmount;

                        // Set other null
                        $product->discount_flat = null;
                    }
                    else if(Input::get('options') == 'flat'){
                        $discountFlat = (double) str_replace('.','', Input::get('discount-flat'));
                        $product->discount_flat = $discountFlat;

                        $product->price_discounted = $priceDouble - $discountFlat;

                        // Set other null
                        $product->discount_flat = null;
                    }
                    else if(Input::get('options') == 'none'){
                        // Set all null
                        $product->discount = null;
                        $product->discount_flat = null;
                        $product->price_discounted = $priceDouble;
                    }
                }

                if(($sizeProperties->count() > 0 && $weightProperties->count() == 0) ||
                    ($sizeProperties->count() == 0 && $weightProperties->count() == 0)){
                    $product->weight = $weight;
                }

                $product->save();

                // Image handling
                $savedId = $product->id;

                if(!empty(Input::get('img_featured_changed') && Input::get('img_featured_changed') === 'new')){
                    // Change old value of featured image

                    if($product->product_image->count() > 0){
                        $currentImgFeatured = $product->product_image()->where('featured',1)->first();
                        $currentImgFeatured->featured = 0;
                        $currentImgFeatured->save();
                    }

                    $img = Image::make($request->file('product-featured'));

                    // Get image extension
                    $extStr = $img->mime();
                    $ext = explode('/', $extStr, 2);

                    $filename = $savedId.'_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '_0.'. $ext[1];

                    $img->save(public_path('storage/product/'. $filename), 75);

                    $productImgFeatured = ProductImage::create([
                        'product_id'    => $savedId,
                        'path'          => $filename,
                        'featured'      => 1
                    ]);

                    $productImgFeatured->save();
                }

//                error_log("Deleted: ". Input::get('deleted_img_id'));

                // Delete product images
                if(!empty(Input::get('deleted_img_id'))){
                    $deletedIdTmp = Input::get('deleted_img_id');

                    if(strpos($deletedIdTmp,',')){
                        $deletedIdList = explode(',', $deletedIdTmp);
                        foreach($deletedIdList as $deletedId){
                            $productImage = ProductImage::find($deletedId);

                            $deletedPath = storage_path('app/public/product/'. $productImage->path);
                            if(file_exists($deletedPath)) unlink($deletedPath);

                            $productImage->delete();
                        }
                    }
                    else{

                        $productImage = ProductImage::find($deletedIdTmp);

                        $deletedPath = storage_path('app/public/product/'. $productImage->path);
                        if(file_exists($deletedPath)) unlink($deletedPath);

                        $productImage->delete();
                    }
                }

                // Change featured value of existing product images
                if(!empty(Input::get('img_featured_changed') && Input::get('img_featured_changed') != 'new')){
                    // Change old value of featured image

                    if($product->product_image->count() > 0){
                        $currentImgFeatured = $product->product_image()->where('featured',1)->first();
                        $currentImgFeatured->featured = 0;
                        $currentImgFeatured->save();
                    }

                    $image = ProductImage::find(Input::get('img_featured_changed'));
                    $image->featured = 1;
                    $image->save();
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


                        $photo->save(public_path('storage/product/'. $filename), 60);

                        $productPhoto = ProductImage::create([
                            'product_id'    => $savedId,
                            'path'          => $filename,
                            'featured'      => 0
                        ]);

                        $productPhoto->save();
                        $idx++;
                    }
                }

                Session::flash('message', 'Product '. $product->name. ' has been saved!');

                return redirect::route('product-list');
            }
        }
        catch(\Exception $ex){
            Utilities::ExceptionLog($ex);
        }
    }
}