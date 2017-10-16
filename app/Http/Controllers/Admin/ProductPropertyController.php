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
use Illuminate\Support\Facades\Validator;

class ProductPropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function index($productId, $name){
        $product = Product::find($productId);
        $properties = $product->product_properties()->where('name', $name)->get();

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
        elseif($name == 'qty'){
            $validator = Validator::make($request->all(),[
                'description'       => 'required|max:50',
                'qty-weight'        => 'required'
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
            'description'   => Input::get('description')
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
                if($name == 'qty') $product->weight = Input::get('qty-weight');

                $product->save();
            }
        }
        else{
            if(Input::get('primary') == 'yes'){
                $property->primary = 1;

                // Change product data
                $product = Product::find($productId);
                $propertyPriceDouble = (double) str_replace('.','', Input::get('price'));
                $product->price = $propertyPriceDouble;
                $product->discount = null;
                $product->discount_flat = null;
                $product->price_discounted = $propertyPriceDouble;

                if($name == 'weight') $product->weight = intval(Input::get('description'));
                if($name == 'qty') $product->weight = Input::get('qty-weight');

                $product->save();

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
        }

        $property->save();

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
                'qty-weight'        => 'required'
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

            if(!empty(Input::get('qty-weight'))){
                $property->weight = Input::get('qty-weight');
            }
        }

        // Check primary
        if($property->primary == 0 && Input::get('primary') == 'yes'){
            $property->primary = 1;

            // Change product data
            $product = Product::find($property->product_id);
            $propertyPriceDouble = (double) str_replace('.','', Input::get('price'));
            $product->price = $propertyPriceDouble;
            $product->discount = null;
            $product->discount_flat = null;
            $product->price_discounted = $propertyPriceDouble;

            if($property->name == 'weight') $product->weight = intval(Input::get('description'));
            if($property->name == 'qty') $product->weight = Input::get('qty-weight');

            $product->save();

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
        else{
            $property->primary = 0;
        }

        $property->save();

        return redirect()->route('product-property-list',['productId' => $property->product_id, 'name' => $property->name]);
    }

    public function delete($id){
        $property = ProductProperty::find($id);
        $property->delete();

        return redirect()->route('product-property-list',['productId' => $property->product_id, 'name' => $property->name]);
    }
}