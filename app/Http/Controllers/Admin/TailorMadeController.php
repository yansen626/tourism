<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 08/09/2017
 * Time: 14:19
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Mail\TailormadeNotification;
use App\Models\TailorMade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class TailorMadeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function index(){
        $tailorMades = TailorMade::all();

        return View('admin.tailormade.index', compact('tailorMades'));
    }

    public function request(){
        $tailorMades = TailorMade::where('status_id', 3)->get();

        return View('admin.tailormade.request', compact('tailorMades'));
    }

    public function confirm(Request $request){
        try {
            $tailorMade = TailorMade::find($request->input('id'));
            $tailorMade->status_id = 6;
            $tailorMade->save();

            //Send Email
            $emailNotification = new TailormadeNotification($request->input('url'));
            Mail::to($tailorMade->email)->send($emailNotification);

            Session::flash('message', 'Berhasil Accept Tailormade!');
            return Response::json(array('success' => 'VALID'));
        }
        catch(\Exception $ex){
            return Response::json(array('errors' => 'INVALID' . $request->input('id')));
        }
    }
}