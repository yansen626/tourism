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
use App\Models\TransactionHeader;
use App\Models\User;
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

    public function transactions($flag){
        //FLAG MEANING
        // 1 = My Booking
        // 2 = Upcoming
        // 3 = History
        $userId = Auth::user()->id;

        $detailCollections = new Collection();
        $transactions = null;
        switch ($flag){
            case 1 :
                $transactions = TransactionHeader::where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;
            case 2 :
                $transactions = TransactionHeader::where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;
            case 3 :
                $transactions = TransactionHeader::where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();
                break;
        }
        foreach ($transactions as $transaction){
            $detailCollections->add($transaction->transaction_details);
        }

            //count by status
        $allCount = $transactions->count();
        $finishedCount = TransactionHeader::where('user_id', $userId)
            ->where('status_id', 8)
            ->count();
        $canceledCount = TransactionHeader::where('user_id', $userId)
            ->where('status_id', 9)
            ->orWhere('status_id', 10)
            ->count();
        $upcomingCount = TransactionHeader::where('user_id', $userId)
            ->where('status_id', 13)
            ->count();


//        $packages = Package::orderBy('created_at', 'desc')->paginate(20);
        $data = [
            'transactions'      => $transactions,
//            'packages'      => $packages,
            'flag'      => $flag,
            'allCount'  => $allCount,
            'finishedCount'  => $finishedCount,
            'canceledCount'  => $canceledCount,
            'upcomingCount'  => $upcomingCount
        ];
//        dd($data);
        return View('frontend.traveler.transactions')->with($data);
    }
}
