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
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index(){
        if(!empty(session('admin_id'))){
            $products = Product::all();

            return View('admin.show-products', compact('products'));
        }
        else{
            return redirect()->route('login-admin');
        }
    }

}