<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 28/08/2017
 * Time: 14:11
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TravelmateConfirmed;
use App\Models\Category;
use App\Models\City;
use App\Models\General;
use App\Models\Package;
use App\Models\PackagePrice;
use App\Models\PackageTrip;
use App\Models\PackageTripImage;
use App\Models\Province;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\Travelmate;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;

class TravelmateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function index()
    {
        $users = Travelmate::all();

        return View('admin.travelmates.index', compact('users'));
        //return view('admin.show_users')->with('users', $users);
    }

    public function showDetail($id, $flag){
        $data = Travelmate::find($id);

        if($flag == 1){
            $route = 'travelmate-new';
        }
        else if($flag == 2){
            $route = 'travelmate-list';
        }

        return View('admin.travelmates.show', compact('data', 'route'));
    }

    public function newTravelmate(){
        $travelmates = Travelmate::where('status_id', 2)->get();

        return View('admin.travelmates.new-travelmate', compact('travelmates'));
    }

    public function confirm(Request $request){
        try{
            $travelmate = Travelmate::find($request->input('id'));
            $travelmate->status_id = 1;
            $travelmate->save();

            //Send Email
            Mail::to($travelmate->email)->send(new TravelmateConfirmed());
            Session::flash('message', 'Berhasil Confirm Travelmate '. $travelmate->first_name . " " . $travelmate->last_name);
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID' . $request->input('id')));
        }
    }

    public function reject(Request $request){
        try{
            $travelmate = Travelmate::find($request->input('id'));
            $travelmate->delete();

            Session::flash('message', 'Berhasil Mengubah Travelmate');
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID' . $request->input('id')));
        }
    }

    public function change(Request $request){
        try{
            $travelmate = Travelmate::find($request->input('id'));

            if($travelmate->status_id == 1){
                $travelmate->status_id = 2;
                Session::flash('message', 'Berhasil Deactivate Travelmate');
            }
            else if($travelmate->status_id == 2){
                $travelmate->status_id = 1;
                Session::flash('message', 'Berhasil Activate Travelmate');
            }
            $travelmate->save();

            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID' . $request->input('id')));
        }
    }

    public function transactions($customerId){
        $transactions = TransactionHeader::where('user_id', $customerId)->orderByDesc('created_at')->get();

        $data = [
            'transactions'  => $transactions,
            'customerId'    => $customerId
        ];

        return View('admin.travelmates.index-transactions')->with($data);
    }

    public function packages(){
        try{
            $filter = 1;
            $status = request()->status;

            if(!empty($status)){
                $filter = $status;
                $packages = Package::where('status_id', $filter)
                    ->orderBy('created_at', 'desc')->get();
            }
            else{
                $packages = Package::where('status_id', 1)->orderBy('created_at', 'desc')->get();
            }
            $data = [
                'packages'      => $packages,
                'filter'      => $filter
            ];
//            dd($data);

            return view('admin.travelmates.index-packages')->with($data);
        }
        catch(\Exception $ex){
            error_log($ex);
        }
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

        return view('admin.travelmates.show-package')->with($data);
    }

    public function createPackage(){
        $provinces = Province::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();

        $data = [
            'provinces'     => $provinces,
            'categories'    => $categories,
        ];

        return View('admin.travelmates.create')->with($data);
    }


    public function storePackage(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name'             => 'required',
                'description'             => 'required',
                'category'             => 'required',
                'start_date'             => 'required',
                'end_date'          => 'required',
                'meeting_point'             => 'required',
                'max_capacity'             => 'required'
            ],
                [
                    'name.required'   => 'Destination field is required',
                    'description.required'   => 'About the trip field is required',

                ]);
            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors())->withInput();

            if (Input::get('province') == "-1") {
                return back()->withErrors("The province is required")->withInput();
            }

            if (Input::get('city') == "-1") {
                return back()->withErrors("The city is required")->withInput();
            }

            //checking destination validation
//            dd($request);
            $tripStartDates = Input::get('trip_start_date');
            $tripEndDates = Input::get('trip_end_date');
            $tripImages = $request->file('trip_image');
            $tripDescriptions = Input::get('trip_description');

//            dd($tripImages);
            $isNullTripStartDates = in_array(null, $tripStartDates, true);
            $isNullTripEndDates = in_array(null, $tripEndDates, true);
            $isNullTripDescriptions = in_array(null, $tripDescriptions, true);
            $isNullTripImages = true;
            if($tripImages != null){
                $isNullTripImages = in_array(null, $tripImages, true);
            }
            if($isNullTripStartDates || $isNullTripEndDates || $isNullTripImages || $isNullTripDescriptions){
                return back()->withErrors("All Destination field required")->withInput();
            }

            //checking price validation
            $pricingQuantities = Input::get('qty');
            $pricingPrice = Input::get('price');
            $isNullPricingQuantities = in_array(null, $pricingQuantities, true);
            $isNullPricingPrice = in_array(null, $pricingPrice, true);

            if($isNullPricingQuantities && $isNullPricingPrice){
                return back()->withErrors("All Pricing field required")->withInput();
            }
            $user = User::find("3a7dcde0-b246-11e7-ba8d-c3ff1c82f7e4");

            $packageID = Uuid::generate();

//            dd($startDateTrip);
            DB::transaction(function() use ($request, $packageID, $user, $tripStartDates,
                $tripEndDates, $tripImages, $tripDescriptions, $pricingQuantities, $pricingPrice) {

                $startDate = Carbon::createFromFormat('d M Y', Input::get('start_date'), 'Asia/Jakarta');
                $endDate = Carbon::createFromFormat('d M Y', Input::get('end_date'), 'Asia/Jakarta');
                $dateTimeNow = Carbon::now('Asia/Jakarta');

                $categories = $request->get('category');
                $selectedCategories = "";
                if($categories != null){
                    foreach ($categories as $category){
                        $selectedCategories.=$category.";";
                    }
                }

                $newPackage = Package::create([
                    'id' =>$packageID,
                    'travelmate_id' => $user->id,
                    'name' => Input::get('name'),
                    'category_id' => $selectedCategories,
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
//            return back()->withErrors($ex)->withInput();
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

        return view('admin.travelmates.edit-info')->with($data);
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

        return view('admin.travelmates.prices.index')->with($data);
    }

    public function createPackagePrice($package_id){
        $packageId = $package_id;
        $general = General::find(1);


        $data = [
            'packageId'     => $packageId,
            'serviceFee'    => $general->service_fee
        ];

        return view('admin.travelmates.prices.create')->with($data);
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

        return view('admin.travelmates.prices.edit')->with($data);
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
        return view('admin.travelmates.trips.index', compact('package'));
    }

    public function createTrip($package_id){
        $packageId = $package_id;

        return view('admin.travelmates.trips.create', compact('packageId'));
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

        $user = Auth::user();
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

        return view('admin.travelmates.trips.edit', compact('trip'));
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

        $user = Auth::user();
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