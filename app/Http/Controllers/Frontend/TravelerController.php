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
use App\Models\Package;
use App\Models\Product;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
use App\Models\User;
use App\Models\UserDiary;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class TravelerController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('auth', ['except' => ['show']]);
    }

    //
    public function show(){
        $userId = request()->userId;
        if(!empty($userId)){
            $user = User::find($userId);
        }
        else{
            $user = Auth::user();
        }
        $diaries = UserDiary::where('user_id', $user->id)->get();
        if(!empty($user->id_card) && empty($user->passport_no)){
            $identity = 'ID CARD';
        }
        elseif(empty($user->id_card) && !empty($user->passport_no)){
            $identity = 'PASSPORT';
        }
        else{
            $identity = '-';
        }

        $allPackages = TransactionDetail::where('user_id', $user->id)
            ->take(4)
            ->get();
        $HistoryPackages = TransactionDetail::where('user_id', $user->id)
            ->where(function ($query) {
                $query->where('status_id', 8)
                    ->orWhere('status_id', 9)
                    ->orWhere('status_id', 10);
            })
            ->take(4)
            ->get();
        $upcomingPackages = TransactionDetail::where('user_id', $user->id)
            ->where('status_id', 13)
            ->take(4)
            ->get();

        $data = [
            'user'      => $user,
            'diaries'  => $diaries,
            'identity'  => $identity,
            'allPackages'  => $allPackages,
            'HistoryPackages'  => $HistoryPackages,
            'upcomingPackages'  => $upcomingPackages,
        ];

        return View('frontend.traveler.show')->with($data);
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

        $allPackages = TransactionDetail::where('user_id', $user->id)
            ->take(4)
            ->get();
        $HistoryPackages = TransactionDetail::where('user_id', $user->id)
            ->where(function ($query) {
                $query->where('status_id', 8)
                    ->orWhere('status_id', 9)
                    ->orWhere('status_id', 10);
            })
            ->take(4)
            ->get();
        $upcomingPackages = TransactionDetail::where('user_id', $user->id)
            ->where('status_id', 13)
            ->take(4)
            ->get();

        $categories = Category::orderBy('name')->get();
        $data = [
            'user'      => $user,
            'identity'  => $identity,
            'allPackages'  => $allPackages,
            'HistoryPackages'  => $HistoryPackages,
            'upcomingPackages'  => $upcomingPackages,
            'categories'  => $categories,
        ];

        return View('frontend.traveler.profile-edit')->with($data);
    }

    public function updateImage(Request $request){
        try{
            $img = Image::make($request->file('image'));

            // Get image extension
            $extStr = $img->mime();
            $ext = explode('/', $extStr, 2);

            $user = \Auth::guard('web')->user();

            $filename = 'traveller_'. $user->id.'_'. Carbon::now('Asia/Jakarta')->format('Ymdhms'). '_0.'. $ext[1];

            $img->save(public_path('storage/profile/'. $filename), 75);

            $userObj = User::find($user->id);
            $oldImage = $userObj->img_path;
            $userObj->img_path = $filename;
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

        $categories = Input::get('travel_interest');
        $selectedCategories = "";
        if($categories != null){
            foreach ($categories as $category){
                $selectedCategories.=$category.";";
            }
        }
        $user->travel_interest = $selectedCategories;

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

    public function transactions($flag){
        //FLAG MEANING
        // 1 = My Booking
        // 2 = Upcoming
        // 3 = History
        // 4 = Finish
        // 5 = Cancel
        $userId = Auth::user()->id;

        $detailCollections = new Collection();
        $transactions = null;
        switch ($flag){
            case 1 :
                $transactions = TransactionDetail::where('user_id', $userId)
                    ->get();
                break;
            case 2 :
                $transactions = TransactionDetail::where('user_id', $userId)
                    ->where('status_id', 13)
                    ->get();
                break;
            case 3 :
                $transactions = TransactionDetail::where('user_id', $userId)
                    ->where(function ($query) {
                        $query->where('status_id', 8)
                            ->orWhere('status_id', 9)
                            ->orWhere('status_id', 10);
                    })
                    ->get();
                break;
            case 4 :
                $transactions = TransactionDetail::where('user_id', $userId)
                    ->where('status_id', 8)
                    ->get();
                break;
            case 5 :
                $transactions = TransactionDetail::where('user_id', $userId)
                    ->where(function ($query) {
                        $query->where('status_id', 9)
                            ->orWhere('status_id', 10);
                    })
                    ->get();
                break;
        }

        //count by status
        $allCount = TransactionDetail::where('user_id', $userId)
            ->count();
        $finishedCount = TransactionDetail::where('user_id', $userId)
            ->where('status_id', 8)
            ->count();
        $canceledCount = TransactionDetail::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('status_id', 9)
                    ->orWhere('status_id', 10);
            })
            ->count();
        $upcomingCount = TransactionDetail::where('user_id', $userId)
            ->where('status_id', 13)
            ->count();

        $allPackages = TransactionDetail::where('user_id', $userId)
            ->take(4)
            ->get();
        $HistoryPackages = TransactionDetail::where('user_id', $userId)
            ->where(function ($query) {
                $query->where('status_id', 8)
                    ->orWhere('status_id', 9)
                    ->orWhere('status_id', 10);
            })
            ->take(4)
            ->get();
        $upcomingPackages = TransactionDetail::where('user_id', $userId)
            ->where('status_id', 13)
            ->take(4)
            ->get();

//        $packages = Package::orderBy('created_at', 'desc')->paginate(20);
        $data = [
            'transactions'      => $transactions,
            'flag'      => $flag,
            'allCount'  => $allCount,
            'finishedCount'  => $finishedCount,
            'canceledCount'  => $canceledCount,
            'upcomingCount'  => $upcomingCount,
            'allPackages'  => $allPackages,
            'HistoryPackages'  => $HistoryPackages,
            'upcomingPackages'  => $upcomingPackages,
        ];
//        dd($data);
        return View('frontend.traveler.transactions')->with($data);
    }


    public function travelDiary(){
        $user = Auth::user();
        $diaries = UserDiary::where('user_id', $user->id)->get();

        if(!empty($diaries->youtube_link) && empty($diaries->image_link)){
            $identity = 'YOUTUBE';
        }
        elseif(empty($diaries->youtube_link) && !empty($diaries->image_link)){
            $identity = 'IMAGE';
        }
        else{
            $identity = 'none';
        }

        $allPackages = TransactionDetail::where('user_id', $user->id)
            ->take(4)
            ->get();
        $HistoryPackages = TransactionDetail::where('user_id', $user->id)
            ->where(function ($query) {
                $query->where('status_id', 8)
                    ->orWhere('status_id', 9)
                    ->orWhere('status_id', 10);
            })
            ->take(4)
            ->get();
        $upcomingPackages = TransactionDetail::where('user_id', $user->id)
            ->where('status_id', 13)
            ->take(4)
            ->get();
        $data = [
            'user'      => $user,
            'diaries'  => $diaries,
            'identity'  => $identity,
            'allPackages'  => $allPackages,
            'HistoryPackages'  => $HistoryPackages,
            'upcomingPackages'  => $upcomingPackages,
        ];

        return View('frontend.traveler.diaries.travel-diaries')->with($data);
    }
    public function travelDiaryEdit($id){
        $user = Auth::user();
        $diaries = UserDiary::find($id);

        if(!empty($diaries->youtube_link) && empty($diaries->image_link)){
            $identity = 'YOUTUBE';
        }
        elseif(empty($diaries->youtube_link) && !empty($diaries->image_link)){
            $identity = 'IMAGE';
        }
        else{
            $identity = 'none';
        }

        $allPackages = TransactionDetail::where('user_id', $user->id)
            ->take(4)
            ->get();
        $HistoryPackages = TransactionDetail::where('user_id', $user->id)
            ->where(function ($query) {
                $query->where('status_id', 8)
                    ->orWhere('status_id', 9)
                    ->orWhere('status_id', 10);
            })
            ->take(4)
            ->get();
        $upcomingPackages = TransactionDetail::where('user_id', $user->id)
            ->where('status_id', 13)
            ->take(4)
            ->get();
//        dd($data);

        $data = [
            'user'      => $user,
            'diaries'  => $diaries,
            'identity'  => $identity,
            'allPackages'  => $allPackages,
            'HistoryPackages'  => $HistoryPackages,
            'upcomingPackages'  => $upcomingPackages,
        ];

        return View('frontend.traveler.diaries.travel-diaries-edit')->with($data);
    }

    public function travelDiaryupdate(Request $request, UserDiary $diary){
        try{
            $validator = Validator::make($request->all(), [
                'description'             => 'required'
            ]);

            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors());

            // Validate Identity No
            if(Input::get('identity') === 'youtube' && empty(Input::get('youtube'))){
                return redirect()->back()->withErrors('Youtube Link is required!', 'default')->withInput($request->all());
            }
//        dd($request);
            if(Input::get('identity') === 'image' && empty($request->file('image'))){
                return redirect()->back()->withErrors('Image is required!', 'default')->withInput($request->all());
            }

            $diary->description = Input::get('description');

            if(Input::get('identity') === 'youtube'){
                $diary->youtube_link = Input::get('youtube');
                $diary->image_link = null;
            }
            else{
                $diary->youtube_link = null;
                $img = Image::make($request->file('image'));

                // Get image extension
                $extStr = $img->mime();
                $ext = explode('/', $extStr, 2);

                $filename = 'diary_'.$diary->id.'_'. $diary->user_id.'.'. $ext[1];

                $img->save(public_path('storage/traveller_diary/'. $filename), 75);
                $diary->image_link = $filename;
            }

            $diary->save();

            Session::flash('message', 'Diary Updated!');

            return redirect()->route('traveller.profile.diary');
        }catch(\Exception $ex){
            error_log($ex);
            return redirect()->back()->withErrors('Something Went Wrong')->withInput($request->all());
        }
    }
    public function travelDiaryAdd(){
        $user = Auth::user();

        $allPackages = TransactionDetail::where('user_id', $user->id)
            ->take(4)
            ->get();
        $HistoryPackages = TransactionDetail::where('user_id', $user->id)
            ->where(function ($query) {
                $query->where('status_id', 8)
                    ->orWhere('status_id', 9)
                    ->orWhere('status_id', 10);
            })
            ->take(4)
            ->get();
        $upcomingPackages = TransactionDetail::where('user_id', $user->id)
            ->where('status_id', 13)
            ->take(4)
            ->get();
        $data = [
            'user'      => $user,
            'allPackages'  => $allPackages,
            'HistoryPackages'  => $HistoryPackages,
            'upcomingPackages'  => $upcomingPackages,
        ];

        return View('frontend.traveler.diaries.travel-diaries-add')->with($data);
    }
    public function travelDiarySubmit(Request $request, User $user){
        try{
            $validator = Validator::make($request->all(), [
                'description'             => 'required'
            ]);

            if ($validator->fails()) return redirect()->back()->withErrors($validator->errors());

            // Validate Identity No
            if(Input::get('identity') === 'youtube' && empty(Input::get('youtube'))){
                return redirect()->back()->withErrors('Youtube Link is required!', 'default')->withInput($request->all());
            }
//        dd($request);
            if(Input::get('identity') === 'image' && empty($request->file('image'))){
                return redirect()->back()->withErrors('Image is required!', 'default')->withInput($request->all());
            }

            $dateTimeNow = Carbon::now('Asia/Jakarta');
            $diary = UserDiary::create([
                'user_id' =>$user->id,
                'description' =>Input::get('description'),
                'created_at'        => $dateTimeNow->toDateTimeString()
            ]);

            if(Input::get('identity') === 'youtube'){
                $diary->youtube_link = Input::get('youtube');
                $diary->image_link = null;
            }
            else{
                $diary->youtube_link = null;
                $img = Image::make($request->file('image'));

                // Get image extension
                $extStr = $img->mime();
                $ext = explode('/', $extStr, 2);

                $filename = 'diary_'.$diary->id.'_'. $diary->user_id.'.'. $ext[1];

                $img->save(public_path('storage/traveller_diary/'. $filename), 75);
                $diary->image_link = $filename;
            }

            $diary->save();

            Session::flash('message', 'New Diary Added!');

            return redirect()->route('traveller.profile.diary');
        }catch(\Exception $ex){
            error_log($ex);
            return redirect()->back()->withErrors('Something Went Wrong')->withInput($request->all());
        }
    }
}
