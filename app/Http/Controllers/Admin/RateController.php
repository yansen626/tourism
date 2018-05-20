<?php
/**
 * Created by PhpStorm.
 * User: GMG-Developer
 * Date: 08/09/2017
 * Time: 14:19
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\General;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user_admins');
    }

    public function edit(){
        $general = General::find(1);

        return View('admin.generals.edit-rate', compact('general'));
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'idrusd'      => 'required',
            'idrrmb'      => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $general = General::find(1);
        $general->idrusd = $request->input('idrusd');
        $general->idrrmb = $request->input('idrrmb');
        $general->save();

        Session::flash('message', 'Berhasil mengubah rate !');

        return redirect('/admin/rate/edit');
    }
}