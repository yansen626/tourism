<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use App\Models\Province;
use App\Models\Travelmate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('guest');
//    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Session::flash('message', 'Your Id is Registered!! Please Login!!');
        $date = Carbon::createFromFormat('d M Y', $data['dob'], 'Asia/Jakarta');

        return User::create([
            'id' =>Uuid::generate(),
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'img_path' => 'default.png',
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => base64_encode($data['email']),
            'phone'                 => $data['phone'],
            'dob'                   => $date->toDateTimeString(),
            'sex'                   => $data['sex'],
            'nationality'           => $data['nationality'],
            'id_card'               => $data['id_card'],
            'passport_no'           => $data['passport_no'],
            'current_location'      => $data['current_location'],
            'speaking_language'     => $data['speaking_language'],
            'travel_interest'       => $data['travel_interest'],
            'about_me'              => $data['about_me'],
            'status_id' => 2
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email'                 => 'required|email|max:100|unique:users',
                'first_name'            => 'required|max:100',
                'last_name'             => 'required|max:100',
                'phone'                 => 'required|max:20',
                'password'              => 'required|min:6|max:20|same:password',
                'password_confirmation' => 'required|same:password',
                'dob'                   => 'required',
                'sex'                   => 'required',
                'nationality'           => 'required',
                'id_card'               => 'required',
                'passport_no'           => 'required',
                'current_location'      => 'required',
                'speaking_language'     => 'required',
                'travel_interest'       => 'required',
                'about_me'              => 'required'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = $this->create($request->all());
//        $emailVerify = new EmailVerification($user);
//        Mail::to($user->email)->send($emailVerify);
//
        $email = Input::get('email');

        return View('auth.send-email', compact('email'));
    }

    public function registerTravelmate(){
//        $path = public_path() . "/data/countries.json";
//
//        $countries = json_decode(file_get_contents($path), true);
        $provinces = Province::all();

        return view('auth.register-travelmate', compact('provinces'));
    }

    public function getCity(Request $request){
        $cities = City::where('province_id', $request->id)->get();

        return $cities;
    }

    public function submitRegisterTravelmate(Request $request){
        $validator = Validator::make($request->all(),
            [
                'email'                 => 'required|email|max:100|unique:users',
                'first_name'            => 'required|max:100',
                'last_name'             => 'required|max:100',
                'phone'                 => 'required|max:20',
                'password'              => 'required|min:6|max:20|same:password',
                'password_confirmation' => 'required|same:password',
                'dob'                   => 'required',
                'sex'                   => 'required',
                'city'               => 'required',
                'province'           => 'required',
                'address'           => 'required',
                'postal_code'           => 'required',
                'occupation'           => 'required',
                'id_card'               => 'required',
                'passport_no'           => 'required',
                'driving_license'           => 'required',
                'current_location'      => 'required',
                'speaking_language'     => 'required',
                'travel_interest'       => 'required',
                'about_me'              => 'required'
            ]
        );

        $date = Carbon::createFromFormat('d M Y', $request->dob, 'Asia/Jakarta');

        $travelmate = Travelmate::create([
            'id'                    => Uuid::generate(),
            'first_name'            => $request->first_name,
            'last_name'             => $request->last_name,
            'img_path'              => 'default.png',
            'email'                 => $request->email,
            'password'              => bcrypt($request->password),
            'phone'                 => $request->phone,
            'dob'                   => $date->toDateTimeString(),
            'sex'                   => $request->sex,
            'city_id'               => $request->city,
            'province_id'           => $request->province,
            'address'           => $request->address,
            'postal_code'           => $request->postal_code,
            'occupation'           => $request->occupation,
            'id_card'               => $request->id_card,
            'passport_no'           => $request->passport_no,
            'driving_license'           => $request->driving_license,
            'current_location'      => $request->current_location,
            'speaking_language'     => $request->speaking_language,
            'travel_interest'       => $request->travel_interest,
            'about_me'              => $request->about_me,
            'description'           => $request->description,
            'status_id'             => 2
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        //Profile Picture
        $img = Image::make($request->file('profile_picture'));
        // Get image extension
        $extStr = $img->mime();
        $ext = explode('/', $extStr, 2);

        $profileName = 'travelmate_profile_'. $travelmate->id. '.' . $ext[1];

        $img->save(public_path('storage/travelmate_profile/'. $profileName), 75);

        $travelmate->profile_picture = $profileName;
        $travelmate->save();

        //Banner Picture
        $banner = Image::make($request->file('banner_picture'));

        // Get image extension
        $extStr = $banner->mime();
        $ext = explode('/', $extStr, 2);

        $bannerName = 'travelmate_banner_'. $travelmate->id. '.' . $ext[1];

        $img->save(public_path('storage/travelmate_banner/'. $bannerName), 75);

        $travelmate->banner_picture = $bannerName;
        $travelmate->save();

        //KTP Image
        $ktp = Image::make($request->file('ktp_img'));

        // Get image extension
        $extStr = $ktp->mime();
        $ext = explode('/', $extStr, 2);

        $ktpName = 'travelmate_ktp_'. $travelmate->id. '.' . $ext[1];

        $img->save(public_path('storage/travelmate_ktp/'. $ktpName), 75);

        $travelmate->ktp_img = $ktpName;
        $travelmate->save();

        return view('auth.finish-register-travelmate');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function verify($token)
    {
        $user = User::where('email_token',$token)->first();
        $user->status_id = 1;

        if($user->save()){
            return View('auth.email-confirm',['user'=>$user]);
        }
    }
}
