<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 28/06/2018
 * Time: 9:07
 */

namespace App\Http\Controllers\Frontend;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\General;
use App\Models\Package;
use App\Models\PackageImage;
use App\Models\PackagePrice;
use App\Models\PackageTrip;
use App\Models\PackageTripImage;
use App\Models\Province;
use App\Models\TransactionDetail;
use App\Models\Travelmate;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;

class TravelmateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:travelmates', ['except' => ['showById']]);
    }

    //
    public function show(){
        $user = \Auth::guard('travelmates')->user();
        if(!empty($user->id_card) && empty($user->passport_no)){
            $identity = 'ID CARD';
        }
        elseif(empty($user->id_card) && !empty($user->passport_no)){
            $identity = 'PASSPORT';
        }
        else{
            $identity = '-';
        }
        $allPackage = TransactionDetail::where('travelmate_id', $user->id)->take(4)->get();
        $upcomingPackage = TransactionDetail::where('travelmate_id', $user->id)
            ->where('status_id', 13)->take(4)->get();

        $data = [
            'user'      => $user,
            'allPackage'      => $allPackage,
            'upcomingPackage'      => $upcomingPackage,
            'identity'  => $identity
        ];

        return View('frontend.travelmate.show')->with($data);
    }
    //
    public function showById($id){
        $user = Travelmate::find($id);
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

        return View('frontend.travelmate.show')->with($data);
    }

    public function edit(){
        $user = \Auth::guard('travelmates')->user();
        if(!empty($user->id_card) && empty($user->passport_no)){
            $identity = 'ID CARD';
        }
        elseif(empty($user->id_card) && !empty($user->passport_no)){
            $identity = 'PASSPORT';
        }
        else{
            $identity = 'none';
        }
        $allPackage = TransactionDetail::where('travelmate_id', $user->id)->take(4)->get();
        $upcomingPackage = TransactionDetail::where('travelmate_id', $user->id)
            ->where('status_id', 13)->take(4)->get();

        $data = [
            'user'      => $user,
            'allPackage'      => $allPackage,
            'upcomingPackage'      => $upcomingPackage,
            'identity'  => $identity
        ];

        return View('frontend.travelmate.profile-edit')->with($data);
    }

    public function updateImage(Request $request){
        try{
            $img = Image::make($request->file('image'));

            // Get image extension
            $extStr = $img->mime();
            $ext = explode('/', $extStr, 2);

            $user = \Auth::guard('travelmates')->user();

            $filename = 'travelmate_'. $user->id.'_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '_0.'. $ext[1];

            $img->save(public_path('storage/profile/'. $filename), 75);

            $userObj = Travelmate::find($user->id);
            $oldImage = $userObj->profile_picture;
            $userObj->profile_picture = $filename;
            $userObj->save();

            // Delete old image
            if($oldImage !== 'default.png'){
                $deletedPath = public_path('storage/profile/'. $oldImage);
                if(file_exists($deletedPath)) unlink($deletedPath);
            }

            return response()->json([
                'append'    => true
            ]);
        }
        catch (\Exception $ex){
            error_log($ex);
        }
    }

    public function update(Request $request, Travelmate $user){
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

        return redirect()->route('travelmate.profile.show');
    }

    public function packages(){
        try{
            $filter = 1;
            $status = request()->status;
            $user = \Auth::guard('travelmates')->user();

            if(!empty($status)){
                $filter = $status;
                $packages = Package::where('travelmate_id', $user->id)
                    ->where('status_id', $filter)
                    ->orderBy('created_at', 'desc')->paginate(20);
            }
            else{
                $packages = Package::where('travelmate_id', $user->id)->orderBy('created_at', 'desc')->paginate(20);
            }
            $packageActiveCount = Package::where('travelmate_id', $user->id)
                ->where('status_id', 1)->count();
            $packageDeactiveCount = Package::where('travelmate_id', $user->id)
                ->where('status_id', 2)->count();

//            $packages = Package::where('travelmate_id', $user->id)->orderBy('created_at', 'desc')->paginate(20);

            $allPackage = TransactionDetail::where('travelmate_id', $user->id)->take(4)->get();
            $upcomingPackage = TransactionDetail::where('travelmate_id', $user->id)
                ->where('status_id', 13)->take(4)->get();
            $data = [
                'packages'      => $packages,
                'packageActiveCount'      => $packageActiveCount,
                'packageDeactiveCount'      => $packageDeactiveCount,
                'allPackage'      => $allPackage,
                'upcomingPackage'      => $upcomingPackage,
                'filter'      => $filter
            ];

            return view('frontend.travelmate.packages.index')->with($data);
        }
        catch(\Exception $ex){
            error_log($ex);
        }
    }

    public function myTrips(){
        try{
            $filter = 0;
            $status = request()->status;

            $user = \Auth::guard('travelmates')->user();
            if(!empty($status) || $status != 0){
                $filter = $status;
//                dd($user->id."|".$filter);
                if($filter == 9){
                    $transactions = TransactionDetail::where('travelmate_id', $user->id)
                        ->where(function ($query) {
                            $query->where('status_id', 9)
                                ->orWhere('status_id', 10);
                        })
                        ->get();
                }
                else{
                    $transactions = TransactionDetail::where('travelmate_id', $user->id)
                        ->where('status_id', $filter)
                        ->get();
                }
            }
            else{
                $transactions = TransactionDetail::where('travelmate_id', $user->id)->paginate(20);
            }

            $allCount = TransactionDetail::where('travelmate_id', $user->id)->count();
            $finishCount = TransactionDetail::where('travelmate_id', $user->id)
                ->where('status_id', 8)->count();
            $cancelCount = TransactionDetail::where('travelmate_id', $user->id)
                ->where(function ($query) {
                    $query->where('status_id', 9)
                        ->orWhere('status_id', 10);
                })
                ->count();
            $upcomingCount = TransactionDetail::where('travelmate_id', $user->id)
                ->where('status_id', 13)->count();

            $allPackage = TransactionDetail::where('travelmate_id', $user->id)->take(4)->get();
            $upcomingPackage = TransactionDetail::where('travelmate_id', $user->id)
                ->where('status_id', 13)->take(4)->get();

            $data = [
                'transactions'      => $transactions,
                'allCount'      => $allCount,
                'finishCount'      => $finishCount,
                'cancelCount'      => $cancelCount,
                'upcomingCount'      => $upcomingCount,
                'allPackage'      => $allPackage,
                'upcomingPackage'      => $upcomingPackage,
                'filter'      => $filter
            ];
//            dd($data);
            return view('frontend.travelmate.my-trips')->with($data);
        }
        catch(\Exception $ex){
            error_log($ex);
        }
    }

    public function createPackage(){
        $provinces = Province::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $view = View::make('frontend.travelmate.partials._trip_destination');
        $content = (string) $view;

        $user = \Auth::guard('travelmates')->user();
        $allPackage = TransactionDetail::where('travelmate_id', $user->id)->take(4)->get();
        $upcomingPackage = TransactionDetail::where('travelmate_id', $user->id)
            ->where('status_id', 13)->take(4)->get();
        $data = [
            'provinces'     => $provinces,
            'categories'    => $categories,
            'allPackage'      => $allPackage,
            'upcomingPackage'      => $upcomingPackage,
            'content'       => $content
        ];

        return view('frontend.travelmate.packages.create')->with($data);
    }

    public function showPackage($id){
        $package = Package::find($id);
        $packagePrices = $package->package_prices;
        $packageTrips = $package->package_trips;

        $data = [
            'package'       => $package,
            'packagePrices' => $packagePrices,
            'packageTrips'  => $packageTrips
        ];

        return view('frontend.travelmate.packages.show')->with($data);
    }

    public function storePackage(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name'             => 'required',
                'description'             => 'required',
                'start_date'             => 'required',
                'end_date'          => 'required',
                'meeting_point'             => 'required',
                'max_capacity'             => 'required'
            ]);
            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput();

            if (Input::get('province') == "-1") {
                return back()->withErrors("The province is required")->withInput();
            }

            if (Input::get('city') == "-1") {
                return back()->withErrors("The city is required")->withInput();
            }

//            dd($request);
            $tripStartDates = Input::get('trip_start_date');
            $tripEndDates = Input::get('trip_end_date');
            $tripImages = $request->file('trip_image');
            $tripDescriptions = Input::get('trip_description');

//            dd($tripImages);
            $isNullTripStartDates = in_array(null, $tripStartDates, true);
            $isNullTripEndDates = in_array(null, $tripEndDates, true);
            $isNullTripImages = in_array(null, $tripImages, true);
            $isNullTripDescriptions = in_array(null, $tripDescriptions, true);

            if($isNullTripStartDates && $isNullTripEndDates && $isNullTripImages && $isNullTripDescriptions){
                return back()->withErrors("All Trip field required")->withInput();
            }

            $pricingQuantities = Input::get('qty');
            $pricingPrice = Input::get('price');
            $isNullPricingQuantities = in_array(null, $pricingQuantities, true);
            $isNullPricingPrice = in_array(null, $pricingPrice, true);

            if($isNullPricingQuantities && $isNullPricingPrice){
                return back()->withErrors("All Pricing field required")->withInput();
            }
            $user = \Auth::guard('travelmates')->user();

            $packageID = Uuid::generate();

//            $startDateTrip = Carbon::createFromFormat('d M Y H:i', $tripStartDates[0], 'Asia/Jakarta');
//            dd($startDateTrip);
            DB::transaction(function() use ($request, $packageID, $user, $tripStartDates,
                $tripEndDates, $tripImages, $tripDescriptions, $pricingQuantities, $pricingPrice) {

                $startDate = Carbon::createFromFormat('d M Y', Input::get('start_date'), 'Asia/Jakarta');
                $endDate = Carbon::createFromFormat('d M Y', Input::get('end_date'), 'Asia/Jakarta');
                $dateTimeNow = Carbon::now('Asia/Jakarta');
                $newPackage = Package::create([
                    'id' =>$packageID,
                    'travelmate_id' => $user->id,
                    'name' => Input::get('name'),
                    'category_id' => Input::get('category'),
                    'province_id' => Input::get('province'),
                    'city_id' => Input::get('city'),
                    'description' => Input::get('description'),
                    'meeting_point' => Input::get('meeting_point'),
                    'max_capacity' => Input::get('max_capacity'),
                    'price' => min($pricingPrice),
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'status_id' => 1,
                    'created_at'        => $dateTimeNow->toDateTimeString()
                ]);

                $img = Image::make($request->file('cover'));
                $extStr = $img->mime();
                $ext = explode('/', $extStr, 2);

                $filename = $packageID.'_featured_'.Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

                $img->save(public_path('storage/package_image/'. $filename), 75);
                $newPackage->featured_image = $filename;
                $newPackage->save();

                //package trips
                for($i=0;$i<sizeof($tripDescriptions);$i++){

                    $startDateTrip = Carbon::createFromFormat('d M Y H:i', $tripStartDates[$i], 'Asia/Jakarta');
                    $endDateTrip = Carbon::createFromFormat('d M Y H:i', $tripEndDates[$i], 'Asia/Jakarta');
                    $newPackageTrip = PackageTrip::create([
                        'package_id' => $packageID,
                        'start_date' => $startDateTrip,
                        'end_date' => $endDateTrip,
                        'description' => $tripDescriptions[$i]
                    ]);

                    $img = Image::make($tripImages[$i]);
                    $extStr = $img->mime();
                    $ext = explode('/', $extStr, 2);

                    $filename = $packageID.'_trip_'.Carbon::now('Asia/Jakarta')->format('Ymdhms'). '.'. $ext[1];

                    $img->save(public_path('storage/package_trip_image/'. $filename), 75);
                    $newPackageTrip->featured_image = $filename;
                    $newPackageTrip->save();
                }

                //package pricing
                $serviceFee = General::find(1);
                for($i=0;$i<sizeof($pricingQuantities);$i++){
                    $total = $pricingQuantities[$i] * $pricingPrice[$i];
                    $final = $total - ((10/100) * $total);

                    $newPackagePrice = PackagePrice::create([
                        'package_id' => $packageID,
                        'quantity' => $pricingQuantities[$i],
                        'price' => $pricingPrice[$i],
                        'service_fee' => $serviceFee->service_fee,
                        'final_price' => $final
                    ]);

                }
            });
            return redirect()->route('travelmate.packages.index');

        }catch(\Exception $ex){
            error_log($ex);
            return back()->withErrors("Something Went Wrong")->withInput();
        }
    }

    public function editPackageInformation(Package $package){
        $provinces = Province::orderBy('name')->get();
        $cities = City::where('province_id', $package->province_id)->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        $data = [
            'package'       => $package,
            'provinces'     => $provinces,
            'cities'        => $cities,
            'categories'    => $categories
        ];

        return view('frontend.travelmate.packages.edit-info')->with($data);
    }

    public function updatePackageInformation(Package $package, Request $request){
        $validator = Validator::make($request->all(),[
            'destination'       => 'required|max:50',
            'start_date'        => 'required',
            'end_date'          => 'required',
            'meeting_point'     => 'required|max:300',
            'max_capacity'      => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Validate province
        if($request->input('province') === '-1'){
            return redirect()->back()->withErrors('Province is required!', 'default')->withInput($request->all());
        }

        // Validate city
        if($request->input('city') === '-1'){
            return redirect()->back()->withErrors('City is required!', 'default')->withInput($request->all());
        }

        $startDate = Carbon::createFromFormat('d F Y', $request->input('start_date'), 'Asia/Jakarta');
        $endDate = Carbon::createFromFormat('d F Y', $request->input('end_date'), 'Asia/Jakarta');

        // Validate date
        if($startDate->gt($endDate)){
            return redirect()->back()->withErrors('End Date must be greater than Start Date!', 'default')->withInput($request->all());
        }

        $user = Auth::user();
        $now = Carbon::now('Asia/Jakarta');

        $package->name = $request->input('destination');
        $package->meeting_point = $request->input('meeting_point');
        $package->max_capacity = $request->input('max_capacity');
        $package->start_date = $startDate->toDateTimeString();
        $package->end_date = $endDate->toDateTimeString();
        $package->updated_by = $user->id;
        $package->updated_at = $now->toDateTimeString();

        $package->save();

        Session::flash('message', 'Package information successfully updated!');

        return redirect()->route('travelmate.packages.information.edit',['package' => $package->id]);
    }

    public function indexPackagePrice(Package $package){
        $data = [
            'package'       => $package
        ];

        return view('frontend.travelmate.packages.prices.index')->with($data);
    }

    public function createPackagePrice($package_id){
        $packageId = $package_id;
        $general = General::find(1);


        $data = [
            'packageId'     => $packageId,
            'serviceFee'    => $general->service_fee
        ];

        return view('frontend.travelmate.packages.prices.create')->with($data);
    }

    public function storePackagePrice(Package $package, Request $request){
        $validator = Validator::make($request->all(),[
            'quantity'      => 'required',
            'price'         => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $qty = (int) $request->input('quantity');

        // Validate quantity
        if(!empty($package->package_prices->where('quantity', $qty)->first())){
            return redirect()->back()->withErrors('Number of Travellers '. $qty. ' already existed!', 'default')->withInput($request->all());
        }

        $priceStr = str_replace('.','', $request->input('price'));

        $packagePrice = PackagePrice::create([
            'package_id'    => $package->id,
            'quantity'      => $qty,
            'price'         => $priceStr
        ]);

        // Get service fee
        $general = General::find(1);
        $serviceFee = $general->service_fee;
        $packagePrice->service_fee = $serviceFee;

        $price = (double) $priceStr;
        $totalPrice = $qty * $price;
        $finalPrice = $totalPrice - ($totalPrice * ($serviceFee / 100));
        $packagePrice->final_price = $finalPrice;
        $packagePrice->save();

        Session::flash('message', 'New Pricing successfully created!');

        return redirect()->route('travelmate.packages.price.index', ['package' => $package->id]);
    }

    public function editPackagePrice(PackagePrice $package_price){
        $pricing = $package_price;

        $data = [
            'pricing'       => $pricing
        ];

        return view('frontend.travelmate.packages.prices.edit')->with($data);
    }

    public function updatePackagePrice(PackagePrice $package_price, Request $request){
        $validator = Validator::make($request->all(),[
            'quantity'      => 'required',
            'price'         => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $qty = (int) $request->input('quantity');

        // Validate quantity
        if(!empty(PackagePrice::where('package_id', $package_price->package_id)
            ->where('id', '!=', $package_price->id)
            ->where('quantity', $qty)
            ->first())){
            return redirect()->back()->withErrors('Duplicate value of Number of Travellers!', 'default')->withInput($request->all());
        }

        $priceStr = str_replace('.','', $request->input('price'));

        $package_price->quantity = $qty;
        $package_price->price = $priceStr;

        // Get service fee
        $serviceFee = $package_price->service_fee;

        $price = (double) $priceStr;
        $totalPrice = $qty * $price;
        $finalPrice = $totalPrice - ($totalPrice * ($serviceFee / 100));
        $package_price->final_price = $finalPrice;
        $package_price->save();

        Session::flash('message', 'New Pricing successfully updated!');

        return redirect()->route('travelmate.packages.price.index', ['package' => $package_price->package_id]);
    }

    public function deletePackagePrice(Request $request){
        try{
            $packagePrice = PackagePrice::find($request->input('id'));
            $packagePrice->delete();

            Session::flash('message', 'Selected Pricing is successfully deleted!');

            return new JsonResponse($packagePrice);
        }
        catch (\Exception $ex){
            error_log($ex);
        }
    }

    public function indexTrip(Package $package){
        return view('frontend.travelmate.packages.trips.index', compact('package'));
    }

    public function createTrip($package_id){
        $packageId = $package_id;

        return view('frontend.travelmate.packages.trips.create', compact('packageId'));
    }

    public function storeTrip(Request $request, $package_id){
        $validator = Validator::make($request->all(),[
            'start_date'        => 'required',
            'end_date'          => 'required',
            'description'       => 'required|max:300',
            'featured'          => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

//        dd($request);

        $start = Carbon::createFromFormat('d F Y G:i', $request->input('start_date'), 'Asia/Jakarta');
        $end = Carbon::createFromFormat('d F Y G:i', $request->input('end_date'), 'Asia/Jakarta');

        // Validate date
        if($start->gt($end)){
            return redirect()->back()->withErrors('End Date must be greater than Start Date!', 'default')->withInput($request->all());
        }

        $user = Auth::guard('travelmates')->user();
        $now = Carbon::now('Asia/Jakarta');

        $trip = PackageTrip::create([
            'package_id'        => $package_id,
            'start_date'        => $start->toDateTimeString(),
            'end_date'          => $end->toDateTimeString(),
            'description'       => $request->input('description'),
            'created_by'        => $user->id,
            'created_at'        => $now->toDateTimeString(),
            'updated_by'        => $user->id,
            'updated_at'        => $now->toDateTimeString()
        ]);

        if(!empty($request->file('featured'))){
            $img = Image::make($request->file('featured'));

            // Get image extension
            $extStr = $img->mime();
            $ext = explode('/', $extStr, 2);

            $filename = $trip->id. '_'. $now->format('Ymdhms'). '_0.'. $ext[1];

            $img->save(public_path('storage/package_trip_image/'. $filename));

            $trip->featured_image = $filename;
            $trip->save();
        }

        if(!empty($request->file('more_images'))){
            $idx = 1;
            foreach($request->file('more_images') as $img){
                error_log('index: '. $idx);
                $photo = Image::make($img);

                // Get image extension
                $extStr = $photo->mime();
                $ext = explode('/', $extStr, 2);

                $filename = $trip->id. '_'. $now->format('Ymdhms'). '_'. $idx. '.'. $ext[1];

                $photo->save(public_path('storage/package_trip_image/'. $filename));

                $images = PackageTripImage::create([
                    'trip_id'           => $trip->id,
                    'filename'          => $filename
                ]);

                $idx++;
            }
        }

        Session::flash('message', 'New Package Trip successfully created!');

        return redirect()->route('travelmate.packages.trip.index', ['package' => $package_id]);
    }

    public function editTrip(PackageTrip $package_trip){
        $trip = $package_trip;

//        dd($trip->description);

        return view('frontend.travelmate.packages.trips.edit', compact('trip'));
    }

    public function updateTrip(Request $request, PackageTrip $package_trip){
        $validator = Validator::make($request->all(),[
            'start_date'        => 'required',
            'end_date'          => 'required',
            'description'       => 'required|max:300'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $start = Carbon::createFromFormat('d F Y G:i', $request->input('start_date'), 'Asia/Jakarta');
        $end = Carbon::createFromFormat('d F Y G:i', $request->input('end_date'), 'Asia/Jakarta');

        // Validate date
        if($start->gt($end)){
            return redirect()->back()->withErrors('End Date must be greater than Start Date!', 'default')->withInput($request->all());
        }

        $user = Auth::guard('travelmates')->user();
        $now = Carbon::now('Asia/Jakarta');

        $package_trip->start_date = $start->toDateTimeString();
        $package_trip->end_date = $end->toDateTimeString();
        $package_trip->description = $request->input('description');
        $package_trip->updated_by = $user->id;
        $package_trip->updated_at = $now->toDateTimeString();

        if(!empty($request->input('featured_changed')) && $request->input('featured_changed') === 'new'){
            $img = Image::make($request->file('featured'));

            // Get image extension
            $extStr = $img->mime();
            $ext = explode('/', $extStr, 2);

            $filename = $package_trip->id. '_'. $now->format('Ymdhms'). '_0.'. $ext[1];

            $img->save(public_path('storage/package_trip_image/'. $filename));

            $oldFeaturedImage = $package_trip->featured_image;
            $package_trip->featured_image = $filename;

            // Delete featured image from server
            $deletedPath = public_path('storage/package_trip_image/'. $oldFeaturedImage);
            if(file_exists($deletedPath)) unlink($deletedPath);
        }

        $package_trip->save();

        // Delete package trip images
        if(!empty($request->input('deleted_images'))){
            $deletedIdTmp = $request->input('deleted_images');

            if(strpos($deletedIdTmp,',')){
                $deletedIdList = explode(',', $deletedIdTmp);
                foreach($deletedIdList as $deletedId){
                    $packageImg = PackageTripImage::find($deletedId);

                    $deletedPath = public_path('storage/package_trip_image/'. $packageImg->filename);
                    if(file_exists($deletedPath)) unlink($deletedPath);

                    $packageImg->delete();
                }
            }
            else{

                $packageImg = PackageTripImage::find($deletedIdTmp);

                $deletedPath = public_path('storage/package_trip_image/'. $packageImg->filename);
                if(file_exists($deletedPath)) unlink($deletedPath);

                $packageImg->delete();
            }
        }

        if(!empty($request->file('more_images'))){
            $idx = 1;
            foreach($request->file('more_images') as $img){
                $photo = Image::make($img);

                // Get image extension
                $extStr = $photo->mime();
                $ext = explode('/', $extStr, 2);

                $filename = $package_trip->id. '_'. $now->format('Ymdhms'). '_'. $idx. '.'. $ext[1];

                $photo->save(public_path('storage/package_trip_image/'. $filename));

                $images = PackageTripImage::create([
                    'trip_id'           => $package_trip->id,
                    'filename'          => $filename
                ]);

                $idx++;
            }
        }

        Session::flash('message', 'Package Trip successfully updated!');

        return redirect()->route('travelmate.packages.trip.edit', ['package_trip' => $package_trip->id]);
    }

    public function deleteTrip(Request $request){
        try{
            error_log('CHECK');

            $trip = PackageTrip::find($request->input('id'));

            // Delete images from server
            if($trip->package_trip_images->count() > 0){
                foreach ($trip->package_trip_images as $image){
                    $deletedPath = public_path('storage/package_trip_image/'. $image->filename);
                    if(file_exists($deletedPath)) unlink($deletedPath);

                    $image->delete();
                }
            }

            $deletedFeaturedPath = public_path('storage/package_trip_image/'. $trip->featured_image);
            if(file_exists($deletedFeaturedPath)) unlink($deletedFeaturedPath);

            $trip->delete();

            Session::flash('message', 'Package Trip successfully deleted!');

            return new JsonResponse($trip);
        }
        catch (\Exception $ex){
            error_log($ex);
        }
    }

    public function getCities(){
        $provinceId = request()->province;

        $cities = City::where('province_id', $provinceId)->get();

        $returnHtml = View('frontend.travelmate.partials._city_options',['cities' => $cities])->render();

        return response()->json( array('success' => true, 'html' => $returnHtml) );
    }
}