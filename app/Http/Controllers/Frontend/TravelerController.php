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
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TravelerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function show(){
        $user = Auth::user();
        if(!empty($user->id_card) && empty($user->passport_no)){
            $identity = 'ID CARD';
        }
        elseif(empty($user->id_card) && !empty($user->passport_no)){
            $identity = 'PASSPORT';
        }
        else{
            $identity = '-';
        }

        $data = [
            'user'      => $user,
            'identity'  => $identity
        ];

        return View('frontend.traveler.index')->with($data);
    }

    public function edit(){
        $user = Auth::user();
        if(!empty($user->id_card) && empty($user->passport_no)){
            $identity = 'ID CARD';
        }
        elseif(empty($user->id_card) && !empty($user->passport_no)){
            $identity = 'PASSPORT';
        }
        else{
            $identity = 'none';
        }

        $data = [
            'user'      => $user,
            'identity'  => $identity
        ];

        return View('frontend.traveler.profile-edit')->with($data);
    }

    public function update(Request $request, User $user){
        $validator = Validator::make($request->all(), [
            'fname'             => 'required|max:50',
            'lname'             => 'required|max:50',
            'about_me'          => 'max:400',
            'phone'             => 'max:20',
            'nationality'       => 'max:20',
            'idcard-value'      => 'max:50',
            'passport-value'    => 'max:50',
            'language'          => 'max:20',
            'interest'          => 'max:50',
            'youtube'           => 'max:100'
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator->errors());

        // Validate Identity No
        if(Input::get('identity') === 'idcard' && empty(Input::get('idcard-value'))){
            return redirect()->back()->withErrors('ID CARD is required!', 'default')->withInput($request->all());
        }

        if(Input::get('identity') === 'passport' && empty(Input::get('passport-value'))){
            return redirect()->back()->withErrors('PASSPORT is required!', 'default')->withInput($request->all());
        }

        $user->first_name = Input::get('fname');
        $user->last_name = Input::get('lname');
        $user->about_me = Input::get('about_me');
        $user->phone = Input::get('phone');
        $user->nationality = Input::get('nationality');
        $user->speaking_language = Input::get('language');
        $user->travel_interest = Input::get('interest');

        if(Input::get('identity') === 'idcard'){
            $user->id_card = Input::get('idcard-value');
            $user->passport_no = null;
        }
        else{
            $user->id_card = null;
            $user->passport_no = Input::get('passport-value');
        }

        $user->save();

        Session::flash('message', 'Profile Updated!');

        return redirect()->route('traveller.profile.show');
    }

    public function transactions(){

        return View('frontend.traveler.transactions');
    }

    public function travelmates($categoryId, $categoryName){

        $products = Product::where('status_id', '=', 1);

        if($categoryId > 0){
            $products = $products->where([['category_id', '=', $categoryId], ['status_id', '=', 1]]);
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

        // Filter ready stock
        // $products = $products->where('is_ready', 1)->orWhere('is_ready', 3);

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
}
