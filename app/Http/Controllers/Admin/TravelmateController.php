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

    public function show($id, $flag){
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
}