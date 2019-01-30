<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\HomeContent;
use App\Models\Package;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Province;
use App\Models\TailorMade;
use App\Models\Travelmate;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    //
    public function Home(Request $request){

//        $recentProducts = Product::where('status_id', 1)
//            ->where('quantity','>',0)
//            ->orderByDesc('created_on')
//            ->take(10)
//            ->get();

//        $recentProducts = Product::where('status_id', 1)
//            ->orderByDesc('created_on')
//            ->take(10)
//            ->get();
//
//        $sliderBanners = Banner::where('type', 1)
//            ->where('status_id', 1)
//            ->get();
//
//        $banner1st = Banner::where('type',2)->where('status_id', 1)->first();
//
//        if(!empty($banner1st->gallery_id) && $banner1st->gallery->status_id == 2){
//            $banner1st = null;
//        }
//
//        $banner2nd = Banner::where('type',3)->where('status_id', 1)->first();
//
//        if(!empty($banner2nd->gallery_id) && $banner2nd->gallery->status_id == 2){
//            $banner2nd = null;
//        }
//
//        $banner3rd = Banner::where('type',4)->where('status_id', 1)->first();
//
//        if(!empty($banner3rd->gallery_id) && $banner3rd->gallery->status_id == 2){
//            $banner3rd = null;
//        }
//
//        $banner4th = Banner::where('type',5)->where('status_id', 1)->first();
//
//        if(!empty($banner4th->gallery_id) && $banner4th->gallery->status_id == 2){
//            $banner4th = null;
//        }
//
//        $categories = Category::orderBy('name')->get();
//        $categoryTotal = $categories->count();
//
//        $cat1Products = Product::where('category_id',3)
//            ->where('status_id', 1)
//            ->inRandomOrder()->take(4)->get();
//        $cat2Products = Product::where('category_id',8)
//            ->where('status_id', 1)
//            ->inRandomOrder()->take(4)->get();
//        $cat3Products = Product::where('category_id',13)
//            ->where('status_id', 1)
//            ->inRandomOrder()->take(4)->get();
//        $cat4Products = Product::where('category_id',4)
//            ->where('status_id', 1)
//            ->inRandomOrder()->take(4)->get();
//        $cat5Products = Product::where('category_id',1)
//            ->where('status_id', 1)
//            ->inRandomOrder()->take(4)->get();
//        $cat6Products = Product::where('category_id',19)
//            ->where('status_id', 1)
//            ->inRandomOrder()->take(4)->get();
//        $cat7Products = Product::where('category_id',23)
//            ->where('status_id', 1)
//            ->inRandomOrder()->take(4)->get();
//        $cat8Products = Product::where('category_id',12)
//            ->where('status_id', 1)
//            ->inRandomOrder()->take(4)->get();
//        $cat9Products = Product::where('category_id',25)
//            ->where('status_id', 1)
//            ->inRandomOrder()->take(4)->get();
//
//        if($categoryTotal % 2 == 1){
//            $firstColumn = ($categoryTotal + 1) / 2;
//        }
//        else{
//            $firstColumn = $categoryTotal / 2;
//        }

        if (Auth::check())
        {
            $userId = Auth::user()->id;
//
//            $carts = Cart::where('user_id', 'like', $userId)->get();
//            $cartTotal = $carts->count();
//
//            Session::put('cartList', $carts);
//            Session::put('cartTotal', $cartTotal);
        }
        else
        {
            $userId = null;
        }
        $request->session()->put('key', 'value');

        $packages = Package::where('status_id', 1)
            ->orderBy('price')
            ->take(4)
            ->get();

        $travelmates = Travelmate::where('status_id', 1)
            ->orderByDesc('rating')
            ->take(5)
            ->get();
        $data = [
//            'recentProducts'    => $recentProducts,
//            'sliderBanners'     => $sliderBanners,
//            'banner1st'         => $banner1st,
//            'banner2nd'         => $banner2nd,
//            'banner3rd'         => $banner3rd,
//            'banner4th'         => $banner4th,
            'packages'          => $packages,
            'travelmates'          => $travelmates,
            'userId'            => $userId,
            'home'=> HomeContent::where('section', 'banner')->get(),
            'video'=> HomeContent::where('section', 'video')->first()
//            'categories'        => $categories,
//            'categoryTotal'     => $categoryTotal,
//            'firstColumn'       => $firstColumn,
//            'cat1Products'      => $cat1Products,
//            'cat2Products'      => $cat2Products,
//            'cat3Products'      => $cat3Products,
//            'cat4Products'      => $cat4Products,
//            'cat5Products'      => $cat5Products,
//            'cat6Products'      => $cat6Products,
//            'cat7Products'      => $cat7Products,
//            'cat8Products'      => $cat8Products,
//            'cat9Products'      => $cat9Products
        ];
//        dd($data);
        return View('frontend.home')->with($data);
    }

    public function terms(){
        return View('frontend.information.terms');
    }
    public function about(){
        return View('frontend.information.about-us');
    }
    public function aboutHTII(){
        return View('frontend.information.about-htii');
    }
    public function cancelation(){
        return View('frontend.information.cancelation-refund');
    }
    public function privacy(){
        return View('frontend.information.privacy');
    }
    public function contact(){
        return View('frontend.information.contact');
    }

    public function SearchResult(Request $request){

        return redirect()->route('destination',
            [
                'search' => $request->input('search'),
                'province' => -1,
                'sortBy' => -1,
            ]);
    }

    //
    public function Travelmates(){
        $travelmates = Travelmate::where('status_id',1)->get();

        $data = [
            'travelmates'      => $travelmates
        ];

        return View('frontend.travelmate.index')->with($data);
    }
    //
    public function Travellers(){
//        dd('adsf');
        $travellers = User::where('status_id',1)->get();

        $data = [
            'travellers'      => $travellers
        ];

        return View('frontend.traveler.index')->with($data);
    }

//    public function Destinations(){
//        $provinceName = "";
//        $id = "";
//        $provinces = Province::all();
//        $packages = Package::where('status_id', 1)->get();
//
//        $data = [
//            'packages'          => $packages,
//            'provinces'          => $provinces,
//            'provinceName'          => $provinceName,
//            'provinceId'          => $id,
//        ];
//        return View('frontend.show-destinations')->with($data);
//    }
    public function Destination(){
        $provinceName = "";
        $provinces = Province::all();
        $provinceId = request()->province;
        $searchText = request()->search;
        $sortBy = request()->sortBy;

//        dd($provinceId." ".$sortBy." ".$searchText);
//        dd($searchText);
        if($sortBy != '-1' && !empty($sortBy)){
            $sortSplit = explode('-',$sortBy);
            $field = $sortSplit[0];
            $sortType = $sortSplit[1];
        }
        //default
        if(empty($provinceId) && empty($sortBy) && empty($searchText)){

            $packages = Package::where('status_id', 1)->get();
            $provinceId = "";
            $searchText = "";
        }
        //province only
        else if($provinceId != '-1' && empty($searchText) && $sortBy == '-1'){
            $packages = Package::where('status_id', 1)
                ->where('province_id', $provinceId)
                ->get();
        }
        //search only
        else if($provinceId == '-1' && !empty($searchText) && $sortBy == '-1'){

            $provinceIds = Province::select('id')->where('name', 'like', '%'.$searchText.'%')->get();

            if($provinceIds->count() != 0){
                $provinceIdArray = array();
                foreach ($provinceIds as $province){
                    array_push($provinceIdArray, $province);
                }

                $packages = Package::where('status_id', 1)
                    ->where('name', 'like', '%'.$searchText.'%')
                    ->orWhere('category_id', 'like', '%'.$searchText.'%')
                    ->orWhere('description', 'like', '%'.$searchText.'%')
                    ->orWhereIn('province_id', $provinceIdArray)
                    ->get();
            }
            else{

                $packages = Package::where('status_id', 1)
                    ->where('name', 'like', '%'.$searchText.'%')
                    ->orWhere('category_id', 'like', '%'.$searchText.'%')
                    ->orWhere('description', 'like', '%'.$searchText.'%')
                    ->get();
            }
        }
        //sort only
        else if($provinceId == '-1' && empty($searchText) && $sortBy != '-1'){
            $packages = Package::where('status_id', 1)
                ->orderBy($field, $sortType)
                ->get();
        }
        //province search and sort
        else if($provinceId != '-1' && !empty($searchText) && $sortBy != '-1'){
            $packages = Package::where('status_id', 1)
//                ->whereIn('travelmate_id', $travelmateId)
                ->where('province_id', $provinceId)
                ->orderBy($field, $sortType)
                ->get();

        }
        // province and search
        else if($provinceId != '-1' && !empty($searchText) && $sortBy == '-1'){
            $packages = Package::where('status_id', 1)
//                ->whereIn('travelmate_id', $travelmateId)
                ->where('province_id', $provinceId)
                ->get();
        }
        // province and sort
        else if($provinceId != '-1' && empty($searchText) && $sortBy != '-1'){
            $packages = Package::where('status_id', 1)
                ->where('province_id', $provinceId)
                ->orderBy($field, $sortType)
                ->get();
        }
        // search and sort
        else if($provinceId == '-1' && empty($searchText) && $sortBy != '-1'){
            $packages = Package::where('status_id', 1)
//                ->whereIn('travelmate_id', $travelmateId)
                ->orderBy($field, $sortType)
                ->get();
        }
        else{
            $packages = Package::where('status_id', 1)->get();
            $provinceId = "";
            $searchText = "";
        }

        $data = [
            'packages'          => $packages,
            'sortBy'          => $sortBy,
            'provinces'          => $provinces,
            'provinceName'          => $provinceName,
            'provinceId'          => $provinceId,
            'searchText'          => $searchText,
        ];

        return View('frontend.show-destinations')->with($data);
    }

    public function TailorMadeForm(){

        return View('frontend.show-search-form');
    }

    public function submitTailorMade(Request $request){
        //Submit Tailor Made Journey
        $validator = Validator::make($request->all(),[
            'email'         => 'required|email',
            'start_date'    => 'required',
            'finish_date'   => 'required',
            'destination'   => 'required',
            'participant'   => 'required',
            'request'       => 'required',
            'budget'        => 'required'
        ]);

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        //Insert Data
        $startDate = Carbon::createFromFormat('d M Y', $request->input('start_date'), 'Asia/Jakarta');
        $finishDate = Carbon::createFromFormat('d M Y', $request->input('finish_date'), 'Asia/Jakarta');
        $budget = str_replace('.','', $request->input('budget'));
        $now = Carbon::now('Asia/Jakarta');

        $tailorMade = TailorMade::create([
            'email'         => $request->input('email'),
            'destination'   => $request->input('destination'),
            'participant'   => $request->input('participant'),
            'request'       => $request->input('request'),
            'start_date'    => $startDate,
            'finish_date'   => $finishDate,
            'budget_per_person'        => $budget,
            'created_at'    => $now->toDateTimeString()
        ]);

        Session::flash('message', 'Terima Kasih atas data yang Anda Submit!');
        return View('frontend.show-search-form');
    }
}
