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
use App\Models\Package;
use App\Models\Province;
use App\Models\Travelmate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

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

        $data = [
            'user'      => $user,
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

        $data = [
            'user'      => $user,
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
            $packages = Package::orderBy('created_at', 'desc')->paginate(20);

            $data = [
                'packages'      => $packages
            ];

            return view('frontend.travelmate.packages.index')->with($data);
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

        $data = [
            'provinces'     => $provinces,
            'categories'    => $categories,
            'content'       => $content
        ];

        return view('frontend.travelmate.packages.create')->with($data);
    }

    public function storePackage(Request $request){
        try{

        }catch(\Exception $ex){
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