<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 09/10/2017
 * Time: 11:29
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductPropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function index($productId, $name){
        $product = Product::find($productId);
        $properties = $product->product_properties()->where('name', $name)->orderBy('price')->get();

        $data = [
            'product'       => $product,
            'properties'    => $properties,
            'propertyName'  => $name
        ];

        return View('admin.show-product-properties')->with($data);
    }

    public function create($productId, $name){
        $product = Product::find($productId);

        // Get product properties
        $weightProperties = ProductProperty::where('product_id', $productId)
            ->where('name', '=', 'weight')
            ->get();

        $sizeProperties = ProductProperty::where('product_id', $productId)
            ->where('name', '=', 'size')
            ->get();

        $qtyProperties = ProductProperty::where('product_id', $productId)
            ->where('name', '=', 'qty')
            ->get();

        $data = [
            'product'           => $product,
            'propertyName'      => $name,
            'weightProperties'  => $weightProperties,
            'sizeProperties'    => $sizeProperties,
            'qtyProperties'     => $qtyProperties
        ];

        return View('admin.create-product-property')->with($data);
    }

    public function store(Request $request, $productId, $name){

        if($name == 'weight'){
            $validator = Validator::make($request->all(),[
                'description'       => 'required|max:50',
                'price'             => 'required'
            ]);
        }
        elseif($name == 'qty' || $name == 'size'){
            $validator = Validator::make($request->all(),[
                'description'       => 'required|max:50',
                'weight'        => 'required'
            ]);
        }
        else{
            $validator = Validator::make($request->all(),[
                'description'       => 'required|max:50'
            ]);
        }


        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $property = ProductProperty::create([
            'product_id'    => $productId,
            'name'          => $name,
            'description'   => Input::get('description'),
            'is_ready'      => Input::get('stock') == 'true' ? 1 : 0
        ]);

        if($name != 'color'){
            // Check property price attribute
            if(!empty(Input::get('price'))){
                $propertyPriceDouble = (double) str_replace('.','', Input::get('price'));
                $property->price = $propertyPriceDouble;
            }
        }

        // Check primary
        $properties = ProductProperty::where('product_id', $productId)
            ->where('name', $name)
            ->get();
        // Check if property added is the first one or not
        if($properties->count() == 1){
            $property->primary = 1;

            if($name != 'color' && !empty(Input::get('price'))){
                // Change product data
                $product = Product::find($productId);
                $propertyPriceDouble = (double) str_replace('.','', Input::get('price'));
                $product->price = $propertyPriceDouble;
                $product->discount = null;
                $product->discount_flat = null;
                $product->price_discounted = $propertyPriceDouble;

                if($name == 'weight') $product->weight = intval(Input::get('description'));
                if($name == 'qty') $product->weight = Input::get('weight');

                $product->save();
            }
        }
        else{
            if(Input::get('primary') == 'yes'){
                $property->primary = 1;

                // Check existing primary property
                $primaryProperty = ProductProperty::where('product_id', $productId)
                    ->where('name', $name)
                    ->where('primary', 1)
                    ->first();

                if(!empty($primaryProperty)){
                    $primaryProperty->primary = 0;
                    $primaryProperty->save();
                }
            }
            else{
                $property->primary = 0;
            }

            // Change product data
            $product = Product::find($productId);
            $propertyPriceDouble = (double) str_replace('.','', Input::get('price'));
            $product->price = $propertyPriceDouble;
            $product->discount = null;
            $product->discount_flat = null;
            $product->price_discounted = $propertyPriceDouble;

            if(Input::get('primary') == 'yes'){
                if($name == 'weight') $product->weight = intval(Input::get('description'));
                if($name == 'qty' || $name == 'size') $product->weight = Input::get('weight');
            }

            $product->save();
        }

        $property->save();

        Session::flash('message', 'New product '. $property->name. ' property has been successfully created!');

        return redirect()->route('product-property-list',['productId' => $productId, 'name' => $name]);
    }

    public function edit($id){
        $property = ProductProperty::find($id);

        return View('admin.edit-product-property', compact('property'));
    }

    public function update(Request $request, $id){
        $property = ProductProperty::find($id);

        if($property->name == 'weight'){
            $validator = Validator::make($request->all(),[
                'description'       => 'required|max:50',
                'price'             => 'required'
            ]);
        }
        elseif($property->name == 'qty'){
            $validator = Validator::make($request->all(),[
                'description'       => 'required|max:50',
                'weight'            => 'required'
            ]);
        }
        elseif($property->name == 'size'){
            $validator = Validator::make($request->all(),[
                'description'       => 'required|max:50',
                'weight'            => 'required'
            ]);
        }
        else{
            $validator = Validator::make($request->all(),[
                'description'       => 'required|max:50'
            ]);
        }

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $property->description = Input::get('description');

        if($property->name != 'color'){
            if(!empty(Input::get('price'))){
                $propertyPriceDouble = (double) str_replace('.','', Input::get('price'));
                $property->price = $propertyPriceDouble;
            }

            if(!empty(Input::get('weight'))){
                $property->weight = Input::get('weight');
            }
        }

        // Check primary
        if($property->primary == 0 && Input::get('primary') == 'yes'){
            $property->primary = 1;

            // Check existing primary property
            $primaryProperty = ProductProperty::where('product_id', $property->product_id)
                ->where('name', $property->name)
                ->where('primary', 1)
                ->first();

            if(!empty($primaryProperty)){
                $primaryProperty->primary = 0;
                $primaryProperty->save();
            }
        }

        // Check stock status
        $property->is_ready = Input::get('stock') == 'true' ? 1 : 0;

        $property->save();

        // Change product data
        $product = Product::find($property->product_id);
        $propertyPriceDouble = (double) str_replace('.','', Input::get('price'));
        $product->price = $propertyPriceDouble;
        $product->discount = null;
        $product->discount_flat = null;
        $product->price_discounted = $propertyPriceDouble;

        // Check overall property stock status
        if(Input::get('stock') == 'true'){
            $product->is_ready = 3;
        }
        else{
            $properties = $product->product_properties()->get();

            $temp = $properties->where('is_ready', 1)->first();

            if($temp == null){
                $product->is_ready = 2;
            }
        }

        $product->save();


        if($property->primary == 1){
            if($property->name == 'weight') $product->weight = intval(Input::get('description'));
            if($property->name == 'qty' || $property->name == 'size') $product->weight = Input::get('weight');
            $property->save();
        }


        Session::flash('message', 'Product '. $property->name. ' property has been saved!');

        return redirect()->route('product-property-list',['productId' => $property->product_id, 'name' => $property->name]);
    }

    public function delete($id){
        $property = ProductProperty::find($id);
        $oldProperty = $property->name;
        $property->delete();

        Session::flash('message', 'Product '. $oldProperty. ' property has been deleted!');

        return redirect()->route('product-property-list',['productId' => $property->product_id, 'name' => $property->name]);
    }
}