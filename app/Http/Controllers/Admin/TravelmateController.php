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
use App\Models\TransactionHeader;
use App\Models\Travelmate;
use App\Models\User;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

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

    public function transactions($customerId){
        $transactions = TransactionHeader::where('user_id', $customerId)->orderByDesc('created_at')->get();

        $data = [
            'transactions'  => $transactions,
            'customerId'    => $customerId
        ];

        return View('admin.travelmates.index-transactions')->with($data);
    }
}