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

        $data = [
            'product'       => $product,
            'propertyName'  => $name
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
//            if(!empty(Input::get('weight'))){
//                $property->weight = Input::get('weight');
//            }

            if(!empty(Input::get('price'))){
                $propertyPriceDouble = (double) str_replace('.','', Input::get('price'));
                $property->price = $propertyPriceDouble;
            }

            $property->save();
        }

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
//            if(!empty(Input::get('weight'))){
//                $property->weight = Input::get('weight');
//            }

            if(!empty(Input::get('price'))){
                $propertyPriceDouble = (double) str_replace('.','', Input::get('price'));
                $property->price = $propertyPriceDouble;
            }
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